<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\OrderDetail;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $items = Item::where('owner_id', $owner->id)
        ->orderBy('name')->paginate(15);

        return view('items.index', compact('items', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $categories = Category::where('owner_id', $owner->id)
        ->orderBy('name')->get();

        return view('items.create', compact('categories', 'owner'));
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
            'description' => 'required|string',
            'price' => 'required',
            'category_id' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'EL nombre es requerido.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.',
            'price.required' => 'El precio es requerido',
            'category_id.required' => 'La categoría es requerida',
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

        for($i=0;$i < count($request->quantity);$i++){
            $prices[] = [
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i]
            ];
        }

        $owner = Owner::where('slug', $request->slug)->first();

        $item = Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => json_encode($prices),
            'img' => 'path',
            'owner_id' => $owner->id
        ]);

        if ($request->hasfile('file')) {
            $file = $request->file;
            $file->move(public_path("storage/items"), $item->id . '.' . $file->getClientOriginalExtension());
        }

        $item->img = "items/" . $item->id . '.' . $file->getClientOriginalExtension();
        $item->save();

        $request->session()->flash('message', 'Producto creado con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/items');
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
        $categories = Category::where('owner_id', $owner->id)
        ->orderBy('name')->get();
        $item = Item::find($id);

        $prices = json_decode($item->price);

        return view('items.edit', compact('categories', 'item', 'prices', 'owner'));
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
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'category_id' => 'required',
            'file' => 'mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'EL nombre es requerido.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.',
            'price.required' => 'El precio es requerido',
            'category_id.required' => 'La categoría es requerida',
            'file.mimes' => 'El archivo debe estar en fomato .jpg o .png',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $item = Item::find($id);

        for($i=0;$i < count($request->quantity);$i++){
            $prices[] = [
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i]
            ];
        }

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $prices
        ]);

        if ($request->hasfile('file')) {
            if ($item->img){
                //Borrar la imagen del servidor
                if (File::exists('storage/' . $item->img)) {
                    unlink('storage/' . $item->img);
                }
            }

            $file = $request->file;
            $file->move(public_path("storage/items"), $item->id . '.' . $file->getClientOriginalExtension());

            $item->img = "items/" . $item->id . '.' . $file->getClientOriginalExtension();
            $item->save();
        }

        $request->session()->flash('message', 'Producto actualizado con éxito.');
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
        $orderDetail = OrderDetail::where('item_id', $id)->first();

        if($orderDetail) {
            $request->session()->flash('message', 'El producto no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        Item::destroy($id);

        $request->session()->flash('message', 'Producto eliminado exitosamente. Gracias por preferirnos.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
