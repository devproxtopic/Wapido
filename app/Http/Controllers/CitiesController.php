<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $cities = City::paginate(15);

        return view('cities.index', compact('cities', 'owner'));
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

        return view('cities.create', compact('owner', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City;
        $city->state_id = $request->state_id;
        $city->name = $request->name;
        $city->save();

        $request->session()->flash('message', 'Ciudad creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/cities');
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
        $city = City::find($id);

        return view('cities.edit', compact('owner', 'countries', 'city'));
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
        $city = City::find($id);
        $city->state_id = $request->state_id;
        $city->name = $request->name;
        $city->save();

        $request->session()->flash('message', 'Ciudad actualizada con éxito.');
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
        $location = Location::where('city_id', $id)->first();

        if ($location) {
            session()->flash('message', 'La ciudad no se puede eliminar porque tiene registros asociados.');
            session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        City::destroy($id);

        session()->flash('message', 'Ciudad eliminada con éxito.');
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

        return view('cities.massive', compact('slug', 'owner'));
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
        $file->move($path, 'cities.' . $file->getClientOriginalExtension());

        $path = public_path() . '/uploads/files/cities.xlsx';

        try {

            Excel::import(new City(), $path);

            unlink($path);
        } catch (\Throwable $th) {

            unlink($path);

            $request->session()->flash('message', 'Ha ocurrido un error al guardar los registros, revise que el archivo tenga el formato adecuado.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        $request->session()->flash('message', 'Locaciones creadas con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/cities');
    }
}
