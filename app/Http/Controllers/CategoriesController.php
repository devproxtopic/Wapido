<?php

namespace App\Http\Controllers;

use App\Classes\CategoryClass;
use App\Classes\OwnerClass;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $ownerClass = new OwnerClass();
        $categoryClass = new CategoryClass();

        $owner = $ownerClass->identityBySlug($slug);

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
        $ownerClass = new OwnerClass();

        $owner = $ownerClass->identityBySlug($slug);

        $units = Unit::orderBy('name')->get();
        return view('categories.create', compact('units', 'owner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {
        $ownerClass = new OwnerClass();
        $categoryClass = new CategoryClass();

        $owner = $ownerClass->identityBySlug($request->slug);

        $dataCategory = [
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            'measure' => json_encode($request->measure),
            'description' => $request->description,
            'img' => 'path',
            'owner_id' => $owner->id
        ];

        $category = $categoryClass->create($dataCategory);

        if($request->hasfile('file')){
            $category = $categoryClass->savePicture($category->id, $request->file);
        }

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
        $ownerClass = new OwnerClass();

        $owner = $ownerClass->identityBySlug($slug);

        $units = Unit::orderBy('name')->get();
        $category = Category::find($id);
        $measures = json_decode($category->measure);

        return view('categories.edit', compact('units', 'category', 'measures', 'owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug, UpdateCategoriesRequest $request, $id)
    {
        $ownerClass = new OwnerClass();
        $categoryClass = new CategoryClass();

        $category = Category::find($id);

        foreach ($request->measure as $measure) {
            if ($measure) {
                $measures[] = $measure;
            }
        }

        $updatePricesItems = $categoryClass->updatePricesByMeasures($category->items, $measures);
        $dataCategory = [
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            'measure' => json_encode($measures),
            'description' => $request->description
        ];

        $categoryClass->update($id, $dataCategory);

        if($request->hasfile('file')){
            //Borrar la imagen del servidor
            if(File::exists('storage/' . $category->img)){
                unlink('storage/' . $category->img);
            }

            $category = $categoryClass->savePicture($category->id, $request->file);
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
