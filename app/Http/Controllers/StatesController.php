<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Owner;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Excel;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $states = State::paginate(15);

        return view('states.index', compact('states', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $countries = Country::orderBy('name')->get();

        return view('states.create', compact('owner', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state = new State;
        $state->country_id = $request->country_id;
        $state->name = $request->name;
        $state->save();

        $request->session()->flash('message', 'Estado creado con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/states');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
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
        $countries = Country::orderBy('name')->get();
        $state = State::find($id);

        return view('states.edit', compact('owner', 'countries', 'state'));
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
        $state = State::find($id);
        $state->country_id = $request->country_id;
        $state->name = $request->name;
        $state->save();

        $request->session()->flash('message', 'Estado actualizado con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        $city = City::where('state_id', $id)->first();

        if ($city) {
            session()->flash('message', 'El estado no se puede eliminar porque tiene registros asociados.');
            session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        State::destroy($id);

        session()->flash('message', 'Estado eliminado con éxito.');
        session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    /**
     * Mostrar vista para cargar masivo
     *
     * @return \Illuminate\Http\Response
     */
    public function massive($slug)
    {
        $owner = Owner::where('slug', $slug)->first();

        return view('states.massive', compact('slug', 'owner'));
    }

    /**
     * Guardar masivo
     *
     * @return \Illuminate\Http\Response
     */
    public function massiveStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx'
        ], [
            'file.required' => 'El archivo es requerido.',
            'file.mimes' => 'El archivo debe estar en formato .xlsx'
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        }

        $file = $request->file('file');

        $path = public_path() . '/uploads/files/';
        $file->move($path, 'states.' . $file->getClientOriginalExtension());

        $path = public_path() . '/uploads/files/states.xlsx';

        try {

            Excel::import(new State(), $path);

            unlink($path);
        } catch (\Throwable $th) {

            unlink($path);

            $request->session()->flash('message', 'Ha ocurrido un error al guardar los registros, revise que el archivo tenga el formato adecuado.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        $request->session()->flash('message', 'Locaciones creadas con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/states');
    }
}
