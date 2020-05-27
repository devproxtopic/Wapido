<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Mail\OrderClientMail;
use App\Mail\OrderOwnerMail;
use App\Notifications\SendOrderNotification;
use App\Order;
use App\OrderDetail;
use App\Owner;
use App\Status;
use App\User;
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
    public function index()
    {
        $orders = Order::paginate(15);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::orderBy('name')->get();
        $clients = Client::orderBy('fullname')->get();

        return view('orders.create', compact('statuses', 'clients'));
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
            'total_amount' => 'required',
            'email' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'quantity' => 'required'
        ], [
            'total_amount.required' => 'Debe comprar algo para realizar el pedido.',
            'email.required' => 'El email es requerido.',
            'fullname.required' => 'El nombre completo es requerido.',
            'phone.required' => 'El teléfono es requerido.',
            'address.required' => 'La dirección es requerido.',
            'quantity.required' => 'La cantidad es requerida.',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Debe comprar algo para realizar el pedido.');
            $request->session()->flash('alert-type', 'error');

            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $client = Client::where('email', $request->email)->first();

        if(! $client){
            $client = Client::create([
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address
            ]);
        }

        $order = Order::create([
            'client_id' => $client->id,
            'total_amount' => $request->total_amount,
            'status_id' => 1,
            'apply_delivery' => $request->apply_delivery,
            'payment' => $request->payment
        ]);

        foreach($request->quantity as $input => $value){
            if(is_numeric($value)){
                /**
                 * Para armar el arreglo, el name($input) esta compuesto por
                 * item_id-measure_category-price_measure
                 */

                $array_values = explode('-', $input);

                $orderDetail = OrderDetail::create([
                    'order_id' => $order->id,
                    'item_id' => $array_values[0],
                    'quantity' => $value,
                    'unit_price' => $array_values[2],
                    'measure' => $array_values[1]
                ]);
            }
        }

        //Enviar Whatsapp con Twilio
        //$message = $this->sendMessage('Se ha creado un nuevo pedido, puede verlo en la siguiente url: ' . route('orders.show', $order->id) , $client->phone);
        $owner = Owner::find(1);

        Mail::to($client->email)->send(new OrderClientMail($order));
        Mail::to($owner->email)->send(new OrderOwnerMail($order));

        $request->session()->flash('message', $order->id);

        //Http::get("https://api.whatsapp.com/send?phone=" . env("TWILIO_NUMBER_DEMO") . "&text=Se%ha%creado%un%nuevo%pedido,%puede%verlo%en%la%siguiente%url:%" . route('orders.show', $order->id));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderDB = Order::findOrFail($id);
        $client = $orderDB->client;

        foreach ($orderDB->details as $detail) {
            $order[$detail->item->category->id][] = [
                'item_id' => $detail->item_id,
                'quantity' => $detail->quantity,
                'measure' => $detail->measure,
                'price' => $detail->unit_price
            ];
        }

        $owner = Owner::find(1);

        return view('order', compact('client', 'order', 'orderDB', 'owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $statuses = Status::orderBy('name')->get();
        $clients = Client::orderBy('fullname')->get();

        return view('orders.edit', compact('statuses', 'clients', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'status_id' => 'required',
            'total_amount' => 'required'
        ], [
            'client_id.required' => 'El cliente es requerido.',
            'status_id.required' => 'El estatus es requerido.',
            'total_amount.required' => 'El total de venta es requerido.'
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

        return back();
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

        return back()->with('message', "Pedido eliminado exitosamente.");
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
