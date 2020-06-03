<?php

namespace App\Http\Controllers;

use App\Imports\LocationImport;
use App\Models\Country;
use App\Models\Location;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Excel;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $locations = Location::paginate(15);

        return view('locations.index', compact('locations', 'owner'));
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

        return view('locations.create', compact('owner', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $location = new Location;
        $location->city_id = $request->city_id;
        $location->name = $request->name;
        $location->save();

        $request->session()->flash('message', 'Zona creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/locations');
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
        $location = Location::find($id);

        return view('locations.edit', compact('owner', 'countries', 'location'));
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
        $location = Location::find($id);
        $location->city_id = $request->city_id;
        $location->name = $request->name;
        $location->save();

        $request->session()->flash('message', 'Zona actualizada con éxito.');
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
        Location::destroy($id);

        session()->flash('message', 'Zona eliminada con éxito.');
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

        return view('locations.massive', compact('slug', 'owner'));
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
        $file->move($path, 'locations.' . $file->getClientOriginalExtension());

        $path = public_path() . '/uploads/files/locations.xlsx';

        try {
            ini_set('memory_limit', '500M');
            Excel::import(new LocationImport(), $path);

            unlink($path);
        } catch (\Throwable $th) {

            dd($th);
            unlink($path);

            $request->session()->flash('message', 'Ha ocurrido un error al guardar los registros, revise que el archivo tenga el formato adecuado.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        $request->session()->flash('message', 'Locaciones creadas con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/locations');
    }
}
