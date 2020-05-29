<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Owner;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();

        $categories = Category::where('owner_id', $owner->id)
        ->orderBy('name')->paginate(15);

        return view('categories.index', compact('categories', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = Owner::where('slug', $slug)->first();

        $units = Unit::orderBy('name')->get();
        return view('categories.create', compact('units', 'owner'));
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
            'name' => 'required|string|unique:categories,name',
            'file' => 'required|mimes:jpeg,jpg,png',
            'description' => 'required|string',
            'measure' => 'required',
            'unit_id' => 'required'
        ], [
            'name.required' => 'EL nombre es requerido.',
            'name.unique' => 'Ya existe una categoria con ese nombre.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'file.required' => 'El archivo de imagen es requerido.',
            'file.mimes' => 'El archivo debe estar en fomato .jpg o .png',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.',
            'measure.required' => 'La medida es requerida',
            'unit_id.required' => 'La unidad es requerida'
        ]);

        if ($validator->fails()) {

            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $owner = Owner::where('slug', $request->slug)->first();

        $category = Category::create([
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            'measure' => json_encode($request->measure),
            'description' => $request->description,
            'img' => 'path',
            'owner_id' => $owner->id
        ]);

        if($request->hasfile('file')){
            $file = $request->file;
            $file->move(public_path("storage/categories"), $category->id . '.' . $file->getClientOriginalExtension());
        }

        $category->img = "categories/" . $category->id . '.' . $file->getClientOriginalExtension();
        $category->save();

        $request->session()->flash('message', 'Categoría creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/'.$request->slug.'/categories');
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
        $owner = Owner::where('slug', $slug)->first();

        $units = Unit::orderBy('name')->get();
        $category = Category::find($id);
        $measures = json_decode($category->measure);

        return view('categories.edit', compact('units', 'category', 'measures', 'owner'));
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
            'description' => 'required|string',
            'measure' => 'required',
            'unit_id' => 'required'
        ], [
            'name.required' => 'El nombre es requerido.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.',
            'measure.required' => 'La medida es requerida',
            'unit_id.required' => 'La unidad es requerida'
        ]);

        $measures = null;

        foreach ($request->measure as $measure) {
            if ($measure) {
                $measures[] = $measure;
            }
        }

        $validator->after(function ($validator) use ($measures) {
            if (! $measures) {
                 $validator->errors()->add('measure', 'Debe agregar al menos una medida.');
            }
        });

        if ($validator->fails()) {

            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $category = Category::find($id);

        $items = $category->items;

        /**
         * Dejar los precios en los items de las cantidades que corresponden
         */
        $newPrices = null;

         foreach($items as $item){
             if(json_decode($item->price) != '' || json_decode($item->price) != null){
                 foreach(json_decode($item->price,true) as $price){
                    for ($i=0; $i < count($measures); $i++) {
                        if($price['quantity'] == $measures[$i]){
                            $newPrices[] = $price;
                        }
                    }
                }

                $item->price = json_encode($newPrices);
                $item->save();
             }
         }

        $category->update([
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            'measure' => json_encode($measures),
            'description' => $request->description
        ]);

        if($request->hasfile('file')){
            //Borrar la imagen del servidor
            if(File::exists('storage/' . $category->img)){
                unlink('storage/' . $category->img);
            }

            $file = $request->file;
            $file->move(public_path("storage/categories"), $category->id . '.' . $file->getClientOriginalExtension());

            $category->img = "categories/" . $category->id . '.' . $file->getClientOriginalExtension();
            $category->save();
        }

        $request->session()->flash('message', 'Categoría actualizada con éxito.');
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
        $items = Item::where('category_id', $id)->first();

        if($items){

            $request->session()->flash('message', 'La categoría no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        Category::destroy($id);

        $request->session()->flash('message', 'Categoría eliminada exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
