<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Http\Requests\OwnerRequest;
use App\Models\CategoryOwner;
use App\Models\Country;
use App\Models\Item;
use App\Models\Order;
use App\Models\Owner;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesOwner = CategoryOwner::orderBy('name')->get();

        return view('owners.create', compact('categoriesOwner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerRequest $request)
    {
        $owner = new Owner();

        $owner->email = $request->email;
        $owner->name = $request->name;
        $owner->phone = $request->phone;
        $owner->logo = 'storage/logo_owner.png';
        $owner->sliders = 'path';
        $owner->slug = Str::slug($request->name);
        $owner->user_id = Auth::id();
        $owner->save();

        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasfile('slider_' . $i)) {
                $nameSlider = 'slider_' . $i;
                $slider = $request->$nameSlider;

                $slider->move(public_path("storage/owners/" . $owner->id), 'slider_' . $i . '.' . $slider->getClientOriginalExtension());

                $sliders[] = 'storage/owners/' . $owner->id . '/slider_' . $i . '.' . $slider->getClientOriginalExtension();
            }
        }

        $logo = $request->logo;
        $logo->move(public_path("storage/owners/" . $owner->id), 'logo.' . $logo->getClientOriginalExtension());

        $owner->logo = 'storage/owners/' . $owner->id . '/logo.' . $logo->getClientOriginalExtension();
        $owner->sliders = json_encode($sliders);
        $owner->save();

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $owner = Owner::find($id);
        session(['owner' => json_encode($owner)]);
        return view('owners.show', compact('owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $owner = Owner::find($id);
        $countries = Country::orderBy('name')->get();
        $categories = CategoryOwner::orderBy('name')->get();

        return view('owners.edit', compact('owner', 'countries', 'categories'));
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
        $owner = Owner::find($id);

        if ($request->hasfile('logo')) {
            if ($owner->logo) {
                //Borrar la imagen del servidor
                if (File::exists($owner->logo)) {
                    unlink($owner->logo);
                }
            }

            $logo = $request->logo;
            $logo->move(public_path("storage/owners/" . $owner->id), 'logo.' . $logo->getClientOriginalExtension());


            $owner->logo = 'storage/owners/' . $owner->id . '/logo.' . $logo->getClientOriginalExtension();
        }

        $owner->update($request->all());

        $request->session()->flash('message', 'Negocio actualizado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back()->with('owner', $owner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Category::where('owner_id', $id)->delete();
        Client::where('owner_id', $id)->delete();
        Item::where('owner_id', $id)->delete();
        Order::where('owner_id', $id)->delete();
        Promotion::where('owner_id', $id)->delete();
        Owner::destroy($id);

        $request->session()->flash('message', 'Negocio eliminado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    public function updateSliders(Request $request)
    {
        $owner = Owner::find($request->id);

        $slidersDB = json_decode($owner->sliders, true);

        if ($request->hasFile('slider_1')) {
            //Borrar la imagen del servidor
            if (File::exists($slidersDB[0])) {
                unlink($slidersDB[0]);
            }
            $slider = $request->slider_1;

            $slider->move(public_path("storage/owners/" . $owner->id), 'slider_1.' . $slider->getClientOriginalExtension());

            $sliders[0] = 'storage/owners/' . $owner->id . '/slider_1.' . $slider->getClientOriginalExtension();
        } else {
            $sliders[0] = $slidersDB[0];
        }

        if ($request->hasFile('slider_2')) {
            //Borrar la imagen del servidor
            if (File::exists($slidersDB[1])) {
                unlink($slidersDB[1]);
            }
            $slider = $request->slider_2;

            $slider->move(public_path("storage/owners/" . $owner->id), 'slider_2.' . $slider->getClientOriginalExtension());

            $sliders[1] = 'storage/owners/' . $owner->id . '/slider_2.' . $slider->getClientOriginalExtension();
        } else {
            $sliders[1] = $slidersDB[1];
        }

        if ($request->hasFile('slider_3')) {
            //Borrar la imagen del servidor
            if (File::exists($slidersDB[2])) {
                unlink($slidersDB[2]);
            }
            $slider = $request->slider_3;

            $slider->move(public_path("storage/owners/" . $owner->id), 'slider_3.' . $slider->getClientOriginalExtension());

            $sliders[2] = 'storage/owners/' . $owner->id . '/slider_3.' . $slider->getClientOriginalExtension();
        } else {
            $sliders[2] = $slidersDB[2];
        }
        $owner->sliders = json_encode($sliders);

        $owner->save();

        $request->session()->flash('message', 'Sliders del negocio actualizados exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    public function ubications(Request $request)
    {
        $owner = Owner::find($request->id);

        $owner->update($request->all());

        $request->session()->flash('message', 'Ubicación del negocio actualizado exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    public function enableOrders(Request $request)
    {
        $owner = Owner::find($request->id);
        $owner->order_enabled = ($owner->order_enabled == 1) ? null : 1;
        $owner->save();

        $request->session()->flash('message', 'Permisos cambiados exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    public function enableReservation(Request $request)
    {
        $owner = Owner::find($request->id);
        $owner->reservations_enabled = ($owner->reservations_enabled == 1) ? null : 1;
        $owner->save();

        $request->session()->flash('message', 'Permisos cambiados exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    public function enableMainDigital(Request $request)
    {
        $owner = Owner::find($request->id);
        $owner->main_digital_enabled = ($owner->main_digital_enabled == 1) ? null : 1;
        $owner->save();

        $request->session()->flash('message', 'Permisos cambiados exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
