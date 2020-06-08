<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PromotionController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = Owner::where('slug', $this->slug)->first();

        $promotions = Promotion::where('owner_id', $owner->id)
        ->orderBy('title')->paginate(15);
        return view('promotions.index', compact('promotions', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owner = Owner::where('slug', $this->slug)->first();
        return view('promotions.create', compact('owner'));
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
        $owner = Owner::where('slug', $request->slug)->first();

        $promotion = Promotion::create([
            'title' => $request->title,
            'description' => $request->description,
            'picture' => 'path',
            'owner_id' => $owner->id
        ]);

        if ($request->hasfile('file')) {
            $file = $request->file;
            $file->move(public_path("storage/promotions"), $promotion->id . '.' . $file->getClientOriginalExtension());
        }

        $promotion->picture = "promotions/" . $promotion->id . '.' . $file->getClientOriginalExtension();
        $promotion->save();

        $request->session()->flash('message', 'Promoción creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/promotions');
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
    public function edit(Request $request)
    {
        $promotion = Promotion::find($request->promotion);
        $owner = Owner::where('slug', $this->slug)->first();

        return view('promotions.edit', compact('promotion','owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

        $promotion = Promotion::find($request->promotion);

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

        $request->session()->flash('message', 'Promoción actualizada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Promotion::destroy($request->id);

        $request->session()->flash('message', 'Promoción eliminada exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
