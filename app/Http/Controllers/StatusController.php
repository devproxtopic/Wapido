<?php

namespace App\Http\Controllers;

use App\Order;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = json_decode(session()->get('owner'));
        $status = Status::paginate(25);
        return view('status.index', compact('status', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = json_decode(session()->get('owner'));
        return view('status.create', compact('owner'));
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
            'name' => 'required',
        ], [
            'name.required' => 'El nombre es requerido.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $status = Status::create($request->all());

        $request->session()->flash('message', 'Estatus creado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->action('StatusController@index');
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
        $owner = json_decode(session()->get('owner'));
        $status = Status::find($id);
        return view('status.edit', compact('status', 'owner'));
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
            'name' => 'required',
        ], [
            'name.required' => 'El nombre es requerido.',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $status = Status::find($id);
        $status->update($request->all());

        $request->session()->flash('message', 'Estatus actualizado exitosamente.');
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
        $order = Order::where('status_id', $id)->first();

        if ($order) {
            $request->session()->flash('message', 'El estatus no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        Status::destroy($id);
        $request->session()->flash('message', 'Estatus eliminada exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
