<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Mail\OrderClientMail;
use App\Mail\OrderOwnerMail;
use App\Notifications\SendOrderNotification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Owner;
use App\Models\Status;
use App\Notifications\NotifyKitchenOrder;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client as Twilio;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $owner = Owner::where('slug', $request->slug)->first();
        $orders = Order::where('owner_id', $owner->id)
        ->getStatus($request->status_filter)
        ->getClient($request->client_filter)
        ->getDateCreated($request->date_created_filter)
        ->paginate(15);

        $status_filter = $request->status_filter;
        $client_filter = $request->client_filter;
        $date_created_filter = $request->date_created_filter;

        return view('orders.index', compact('orders', 'owner', 'date_created_filter',
            'status_filter', 'client_filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $owner = Owner::where('slug', $request->slug)->first();
        $statuses = Status::orderBy('name')->get();
        $clients = Client::where('owner_id', $owner->id)->orderBy('fullname')->get();
        $number_table = $request->table ? $request->table : null;

        return view('orders.create', compact('statuses', 'clients', 'owner', 'number_table'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'total_amount' => 'required|numeric|min:1',
            'email' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'nullable'
        ], [
            'total_amount.required' => 'Debe comprar algo para realizar el pedido.',
            'total_amount.numeric' => 'Debe comprar algo para realizar el pedido',
            'total_amount.min' => 'Debe comprar algo para realizar el pedido',
            'email.required' => 'El email es requerido.',
            'fullname.required' => 'El nombre completo es requerido.',
            'phone.required' => 'El teléfono es requerido.'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Debe comprar algo para realizar el pedido.');
            $request->session()->flash('alert-type', 'error');

            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $owner = Owner::where('slug', $request->slug)->first();
        $client = Client::where('email', $request->email)->first();

        if(! $client){
            $client = Client::create([
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'owner_id' => $owner->id
            ]);
        }

        $order = Order::create([
            'client_id' => $client->id,
            'total_amount' => $request->total_amount,
            'status_id' => 1,
            'apply_delivery' => $request->apply_delivery,
            'payment' => $request->payment,
            'owner_id' => $owner->id,
            'number_table' => $request->number_table
        ]);

        if($request->quantity) {
            foreach ($request->quantity as $input => $value) {
                if (is_numeric($value)) {
                    /**
                     * Para armar el arreglo, el name($input) esta compuesto por
                     * item_id-measure_category-price_measure
                     */

                    $array_values = explode('-', $input);

                    if($value){
                        $orderDetail = OrderDetail::create([
                            'order_id' => $order->id,
                            'item_id' => $array_values[0],
                            'quantity' => $value,
                            'unit_price' => $array_values[2],
                            'measure' => $array_values[1]
                        ]);
                    }
                }
            }
        }

        if ($request->quantity_food) {
            foreach($request->quantity_food as $input => $value){
                /**
                 * Para armar el arreglo, el name($input) esta compuesto por
                 * item_id-price_measure
                 */

                $array_values = explode('-', $input);

                if ($value) {
                    $orderDetail = OrderDetail::create([
                        'order_id' => $order->id,
                        'food_id' => $array_values[0],
                        'quantity' => $value,
                        'unit_price' => $array_values[1],
                        'measure' => 1
                    ]);
                }
            }
        }

        //Enviar Whatsapp con Twilio
        //$message = $this->sendMessage('Se ha creado un nuevo pedido, puede verlo en la siguiente url: ' . route('orders.show', $order->id) , $client->phone);

        if($request->number_table){
            try{
                foreach($owner->employees as $employee) {
                    Notification::send($employee->user, new NotifyKitchenOrder($order));
                }
            }
            catch(Exception $e){

            }
        }else{
            try {
                Mail::to($client->email)->send(new OrderClientMail($order));
                Mail::to($owner->email)->send(new OrderOwnerMail($order));
            } catch (Exception $e) {
            }
        }

        $request->session()->flash('message', $order->id);

        //Http::get("https://api.whatsapp.com/send?phone=" . env("TWILIO_NUMBER_DEMO") . "&text=Se%ha%creado%un%nuevo%pedido,%puede%verlo%en%la%siguiente%url:%" . route('orders.show', $order->id));

        return redirect()->back()->with('main', $request->main);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        $orderDB = Order::findOrFail($id);
        $client = $orderDB->client;

        foreach ($orderDB->details as $detail) {
            if($detail->item){
                $order[$detail->item->category->id][] = [
                    'item_id' => $detail->item_id,
                    'quantity' => $detail->quantity,
                    'measure' => $detail->measure,
                    'price' => $detail->unit_price,
                    'item' => 1
                ];
            }

            if($detail->food){
                $order[$detail->food->category->id][] = [
                    'food_id' => $detail->food_id,
                    'quantity' => $detail->quantity,
                    'measure' => $detail->measure,
                    'price' => $detail->unit_price,
                    'item' => 0
                ];
            }
        }

        $owner = Owner::where('slug', $slug)->first();

        return view('order', compact('client', 'order', 'orderDB', 'owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $owner = Owner::where('slug', $slug)->first();
        $order = Order::find($id);
        $statuses = Status::orderBy('name')->get();
        $clients = Client::orderBy('fullname')->get();

        return view('orders.edit', compact('statuses', 'clients', 'order', 'owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug, Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status_id' => 'required',
            'total_amount' => 'required',
            'confirm_date' => 'before:'.now()
        ], [
            'status_id.required' => 'El estatus es requerido.',
            'total_amount.required' => 'El total de venta es requerido.',
            'confirm.date' => 'Fecha no válida'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $order = Order::find($id);

        $order->update($request->all());

        $request->session()->flash('message', 'Pedido actualizado exitosamente');
        $request->session()->flash('alert-type', 'success');

        return redirect('/owners/' . $slug . '/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect()->back()->with('message', "Pedido eliminado exitosamente.");
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients Number of recipient
     *
     */

    private function sendMessage($message, $recipients)
    {
        $account_sid = env("TWILIO_SID");
        $auth_token = env("TWILIO_AUTH_TOKEN");
        $twilio_number = env("TWILIO_NUMBER");
        $twilio_number2 = env("TWILIO_NUMBER2");

        try {
            $client = new Twilio($account_sid, $auth_token);
            $message_send = $client->messages->create('whatsapp:'. $recipients, ['from' => 'whatsapp:+14155238886', 'body' => $message]);
        } catch (\Throwable $th) {
            $message_send = null;
            Log::info($th->getMessage());
        }

        return $message_send;
    }
}
