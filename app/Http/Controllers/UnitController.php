<?php

namespace App\Http\Controllers;

use App\Category;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::paginate(25);
        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.create');
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
            'symbol' => 'required'
        ], [
            'name.required' => 'El nombre es requerido.',
            'symbol.required' => 'El simbolo es requerido'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error');
            $request->session()->flash('alert-type', 'error');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $unit = Unit::create($request->all());

        $request->session()->flash('message', 'Unidad creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->action('UnitController@index');
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
        $unit = Unit::find($id);
        return view('units.edit', compact('unit'));
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
            'name' => 'required',
            'symbol' => 'required'
        ], [
            'name.required' => 'El nombre es requerido.',
            'symbol.required' => 'El simbolo es requerido'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error');
            $request->session()->flash('alert-type', 'error');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $unit = Unit::find($id);
        $unit->unpdate($request->all());

        $request->session()->flash('message', 'Unidad actualizada con éxito.');
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
        $category = Category::where('unit_id', $id)->first();

        if ($category) {
            $request->session()->flash('message', 'La categoria no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return back();
        }

        Unit::destroy($id);
        $request->session()->flash('message', 'Unidad eliminada exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return back();
    }
}
