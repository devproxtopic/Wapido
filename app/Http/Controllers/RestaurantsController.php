<?php

namespace App\Http\Controllers;

use App\Models\CategoryFood;
use App\Models\Country;
use App\Models\Owner;
use Illuminate\Http\Request;

class RestaurantsController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::orderBy('name')->get();

        $state_id = $request->state_id;
        $city_id = $request->city_id;
        $location_id = $request->location_id;
        $country_id = $request->country_id;
        $category_food_id = $request->category_food_id;

        //7 Categoria Restaurante
        $restaurants = Owner::getCategory(7)->getCountry($country_id)
            ->getState($state_id)->getCity($city_id)->getLocation($location_id)
            ->getTypeFood($category_food_id)->get();

        $categories_food = CategoryFood::orderBy('name')->get();

        return view('restaurants', compact('restaurants', 'countries', 'categories_food', 'state_id', 'city_id', 'location_id', 'country_id', 'category_food_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
