<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Owner;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Excel;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $countries = Country::paginate(15);

        return view('countries.index', compact('countries', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = Owner::where('slug', $slug)->first();

        return view('countries.create', compact('owner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country;
        $country->name = $request->name;
        $country->phone_prefix = $request->phone_prefix;
        $country->save();

        $request->session()->flash('message', 'País creado con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/countries');
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
        $country = Country::find($id);

        return view('countries.edit', compact('owner', 'countries', 'country'));
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
        $country = Country::find($id);
        $country->name = $request->name;
        $country->phone_prefix = $request->phone_prefix;
        $country->save();

        $request->session()->flash('message', 'País actualizado con éxito.');
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
        $state = State::where('country_id', $id)->first();

        if ($state) {
            session()->flash('message', 'El pais no se puede eliminar porque tiene registros asociados.');
            session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        Country::destroy($id);

        session()->flash('message', 'País eliminado con éxito.');
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

        return view('countries.massive', compact('slug', 'owner'));
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
        $file->move($path, 'countries.' . $file->getClientOriginalExtension());

        $path = public_path() . '/uploads/files/countries.xlsx';

        try {

            Excel::import(new Country(), $path);

            unlink($path);
        } catch (\Throwable $th) {

            unlink($path);

            $request->session()->flash('message', 'Ha ocurrido un error al guardar los registros, revise que el archivo tenga el formato adecuado.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        $request->session()->flash('message', 'Paises creados con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/countries');
    }
}
