<?php

namespace App\Http\Controllers;

use App\Models\CategoryOwner;
use App\Models\Owner;
use Illuminate\Http\Request;

class CategoryOwnerController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = Owner::where('slug', $this->slug)->first();

        $categories_owner = CategoryOwner::orderBy('name')->paginate(15);
        return view('categories_owner.index', compact('categories_owner', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owner = Owner::where('slug', $this->slug)->first();
        return view('categories_owner.create', compact('owner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $owner = Owner::where('slug', $request->slug)->first();

        $category_owner = CategoryOwner::create([
            'name' => $request->name
        ]);

        $request->session()->flash('message', 'Categoría de Negocio creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/categories-owner');
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
        $category_owner = CategoryOwner::find($request->categories_owner);
        $owner = Owner::where('slug', $this->slug)->first();

        return view('categories_owner.edit', compact('category_owner', 'owner'));
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
        $category_owner = CategoryOwner::find($request->categories_owner);

        $category_owner->update([
            'name' => $request->name
        ]);

        $request->session()->flash('message', 'Categoría de Negocio actualizada con éxito.');
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
        $owner = Owner::where('category_owner_id', $request->id)->first();

        if($owner){
            $request->session()->flash('message', 'La categoria no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        CategoryOwner::destroy($request->id);

        $request->session()->flash('message', 'Categoría de Negocio eliminada exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
