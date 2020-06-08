<?php

namespace App\Http\Controllers;

use App\Models\CategoryFood;
use App\Models\Food;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $foods = Food::where('owner_id', $owner->id)->paginate(15);

        return view('foods.index', compact('owner', 'foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $categoryFoods = CategoryFood::orderBy('name')->get();

        return view('foods.create', compact('owner', 'categoryFoods'));
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

        $food = new Food();
        $food->owner_id = $owner->id;
        $food->category_food_id = $request->category_food_id;
        $food->name = $request->name;
        $food->price = $request->price;
        $food->picture = 'path';
        $food->save();

        if ($request->hasfile('file')) {
            $file = $request->file;
            $file->move(public_path("storage/foods"), $food->id . '.' . $file->getClientOriginalExtension());
        }

        $food->picture = "foods/" . $food->id . '.' . $file->getClientOriginalExtension();
        $food->save();

        $request->session()->flash('message', 'Comida creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/foods');
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
        $food = Food::find($id);
        $categoryFoods = CategoryFood::orderBy('name')->get();

        return view('foods.edit', compact('owner', 'food', 'categoryFoods'));
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
        $food = Food::find($id);
        $food->name = $request->name;
        $food->category_food_id = $request->category_food_id;
        $food->price = $request->price;
        $food->save();

        if ($request->hasfile('file')) {

            if($food->picture){
                //Borrar la imagen del servidor
                if (File::exists('storage/' . $food->picture)) {
                    unlink('storage/' . $food->picture);
                }
            }

            $file = $request->file;
            $file->move(public_path("storage/foods"), $food->id . '.' . $file->getClientOriginalExtension());

            $food->picture = "foods/" . $food->id . '.' . $file->getClientOriginalExtension();
            $food->save();
        }

        $request->session()->flash('message', 'Comida actualizada con éxito.');
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
        Food::destroy($id);

        session()->flash('message', 'Comida eliminada con éxito.');
        session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
