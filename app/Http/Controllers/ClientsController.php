<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $clients = Client::where('owner_id', $owner->id)
            ->paginate(15);

        return view('clients.index', compact('clients', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        return view('clients.create', compact('owner'));
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

        $owner = Owner::where('slug', $request->slug)->first();

        $client = Client::create($request->all());

        $client->owner_id = $owner->id;
        $client->save();

        $request->session()->flash('message', 'Cliente creado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/clients');
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
    public function edit($slug, $id)
    {
        $owner = Owner::where('slug', $slug)->first();
        $client = Client::find($id);
        return view('clients.edit', compact('client', 'owner'));
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

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id, Request $request)
    {
        $orders = Order::where('client_id', $id)->first();

        if($orders) {
            $request->session()->flash('message', 'El cliente no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        Client::destroy($id);

        $request->session()->flash('message', 'Cliente eliminado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
