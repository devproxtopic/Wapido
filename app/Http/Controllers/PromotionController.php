<?php

namespace App\Http\Controllers;

use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::orderBy('title')->paginate(15);
        return view('promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promotions.create');
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
            'title' => 'required|string',
            'file' => 'required|mimes:jpeg,jpg,png',
            'description' => 'required|string',
        ], [
            'title.required' => 'EL nombre es requerido.',
            'title.string' => 'El nombre no tiene un formato válido.',
            'file.required' => 'El archivo de imagen es requerido.',
            'file.mimes' => 'El archivo debe estar en fomato .jpg o .png',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.'
        ]);

        if ($validator->fails()) {

            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $promotion = Promotion::create([
            'title' => $request->title,
            'description' => $request->description,
            'picture' => 'path'
        ]);

        if ($request->hasfile('file')) {
            $file = $request->file;
            $file->move(public_path("storage/promotions"), $promotion->id . '.' . $file->getClientOriginalExtension());
        }

        $promotion->picture = "promotions/" . $promotion->id . '.' . $file->getClientOriginalExtension();
        $promotion->save();

        $request->session()->flash('message', 'Promoción creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->action('PromotionController@index');
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
        $promotion = Promotion::find($id);

        return view('promotions.edit', compact('promotion'));
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
            'title' => 'required',
            'description' => 'required|string'
        ], [
            'title.required' => 'El nombre es requerido.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.'
        ]);

        if ($validator->fails()) {

            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $promotion = Promotion::find($id);

        $promotion->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        if ($request->hasfile('file')) {
            //Borrar la imagen del servidor
            if (File::exists('storage/' . $promotion->picture)) {
                unlink('storage/' . $promotion->picture);
            }

            $file = $request->file;
            $file->move(public_path("storage/promotions"), $promotion->id . '.' . $file->getClientOriginalExtension());

            $promotion->picture = "promotions/" . $promotion->id . '.' . $file->getClientOriginalExtension();
            $promotion->save();
        }

        $request->session()->flash('message', 'Categoría actualizada con éxito.');
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
        Promotion::destroy($id);

        $request->session()->flash('message', 'Categoría eliminada exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return back();
    }
}
