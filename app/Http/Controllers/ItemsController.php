<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('name')->paginate(15);

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('items.create', compact('categories'));
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
            'category_id' => 'required'
        ], [
            'name.required' => 'EL nombre es requerido.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.',
            'price.required' => 'El precio es requerido',
            'category_id.required' => 'La categoría es requerida'
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

        $item = Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => json_encode($prices)
        ]);

        $request->session()->flash('message', 'Producto creado con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->action('ItemsController@index');
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
        $categories = Category::orderBy('name')->get();
        $item = Item::find($id);

        $prices = json_decode($item->price);

        return view('items.edit', compact('categories', 'item', 'prices'));
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
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'category_id' => 'required'
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'description.required' => 'La descripción es requerida.',
            'description.string' => 'La descripción no tiene un formato válido.',
            'price.required' => 'El precio es requerido',
            'category_id.required' => 'La categoría es requerida'
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

        $request->session()->flash('message', 'Producto actualizado con éxito.');
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
        $orderDetail = OrderDetail::where('item_id', $id)->first();

        if($orderDetail) {
            $request->session()->flash('message', 'El producto no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return back();
        }

        Item::destroy($id);

        $request->session()->flash('message', 'Producto eliminado exitosamente. Gracias por preferirnos.');
        $request->session()->flash('alert-type', 'success');

        return back();
    }
}
