<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(15);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            'email' => 'required|string|email|unique:clients,email',
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ], [
            'email.required' => 'El correo es requerido.',
            'email.unique' => 'Ya existe un cliente con ese correo.',
            'email.string' => 'El correo no tiene un formato válido.',
            'email.email' => 'El correo no tiene un formato válido.',
            'fullname.required' => 'El nombre completo es requerido.',
            'phone.required' => 'El teléfono es requerido.',
            'address.required' => 'La dirección es requerida'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Client::create($request->all());

        $request->session()->flash('message', 'Cliente creado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->action('ClientsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit', compact('client'));
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
            'email' => 'required|string|email',
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ], [
            'email.required' => 'El correo es requerido.',
            'email.string' => 'El correo no tiene un formato válido.',
            'email.email' => 'El correo no tiene un formato válido.',
            'fullname.required' => 'El nombre completo es requerido.',
            'phone.required' => 'El teléfono es requerido.',
            'address.required' => 'La dirección es requerida'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $client = Client::find($id);

        $client->update($request->all());

        $request->session()->flash('message', 'Cliente actualizado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $orders = Order::where('client_id', $id)->first();

        if($orders) {
            $request->session()->flash('message', 'El cliente no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return back();
        }

        Client::destroy($id);

        $request->session()->flash('message', 'Cliente eliminado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return back();
    }
}
