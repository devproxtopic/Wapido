<?php

namespace App\Http\Controllers;

use App\Models\CategoryFood;
use App\Models\OrderDetail;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryFoodController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = Owner::where('slug', $this->slug)->first();

        $categories_food = CategoryFood::orderBy('name')->paginate(15);
        return view('categories_food.index', compact('categories_food', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owner = Owner::where('slug', $this->slug)->first();
        return view('categories_food.create', compact('owner'));
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
            'name' => 'required|string',
            'file' => 'required|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'EL nombre es requerido.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'file.required' => 'El archivo de imagen es requerido.',
            'file.mimes' => 'El archivo debe estar en fomato .jpg o .png',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $owner = Owner::where('slug', $request->slug)->first();

        $category_food = CategoryFood::create([
            'name' => $request->name,
            'picture' => 'path'
        ]);

        if ($request->hasfile('file')) {
            $file = $request->file;
            $file->move(public_path("storage/categories_food"), $category_food->id . '.' . $file->getClientOriginalExtension());
        }

        $category_food->picture = "categories_food/" . $category_food->id . '.' . $file->getClientOriginalExtension();
        $category_food->save();

        $request->session()->flash('message', 'Categoría de Comida creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/categories-food');
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
        $category_food = CategoryFood::find($request->categories_food);
        $owner = Owner::where('slug', $this->slug)->first();

        return view('categories_food.edit', compact('category_food', 'owner'));
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
        $category_food = CategoryFood::find($request->categories_food);

        $category_food->update([
            'name' => $request->name
        ]);

        if ($request->hasfile('file')) {

            if($category_food->picture){
                //Borrar la imagen del servidor
                if (File::exists('storage/' . $category_food->picture)) {
                    unlink('storage/' . $category_food->picture);
                }
            }

            $file = $request->file;
            $file->move(public_path("storage/categories_food"), $category_food->id . '.' . $file->getClientOriginalExtension());

            $category_food->picture = "categories_food/" . $category_food->id . '.' . $file->getClientOriginalExtension();
            $category_food->save();
        }

        $request->session()->flash('message', 'Categoría de Comida actualizada con éxito.');
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
        $owner = OrderDetail::where('food_id', $request->id)->first();

        if ($owner) {
            $request->session()->flash('message', 'La categoria no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        CategoryFood::destroy($request->id);

        $request->session()->flash('message', 'Categoría de Comida eliminada exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
