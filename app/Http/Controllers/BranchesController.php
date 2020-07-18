<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchZipCode;
use App\Models\Country;
use App\Models\OrderDetail;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchesController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = Owner::where('slug', $this->slug)->first();

        $branches = Branch::orderBy('name')->paginate(15);
        return view('branches.index', compact('branches', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owner = Owner::where('slug', $this->slug)->first();
        $countries = Country::all();

        return view('branches.create', compact('owner', 'countries'));
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
            'address' => 'required|string',
            'phone' => 'required',
            'quantity_people' => 'required',
            'quantity_tables' => 'required',
            'email' => 'required|unique:branches,email'
        ], [
            'name.required' => 'EL nombre es requerido.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'address.required' => 'La dirección es requerida.',
            'address.string' => 'La dirección no tiene un formato válido.',
            'phone.required' => 'El telefóno es requerido',
            'quantity_people.required' => 'La cantidad de personas es requerida',
            'quantity_tables.required' => 'La cantidad de mesas es requerido.',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya se encuentra registrado'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $branch = Branch::create($request->all());

        //Guardar códigos postales de la sucursal
        foreach ($request->zipcodes as $zipcode) {
            $branch_zipcode = new BranchZipCode();
            $branch_zipcode->zipcode = $zipcode;
            $branch_zipcode->branch_id = $branch->id;
            $branch_zipcode->save();
        }

        $request->session()->flash('message', 'Sucursal creada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/branches');
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
        $owner = Owner::where('slug', $this->slug)->first();
        $countries = Country::all();
        $branch = Branch::find($request->branch);

        $zipcodes = json_decode($branch->zipcodes);

        return view('branches.edit', compact('owner', 'countries', 'branch', 'zipcodes'));
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
        $branch = Branch::find($request->branch);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required',
            'quantity_people' => 'required',
            'quantity_tables' => 'required',
            'email' => 'required|unique:branches,email,' . $branch->id . ',id'
        ], [
            'name.required' => 'EL nombre es requerido.',
            'name.string' => 'El nombre no tiene un formato válido.',
            'address.required' => 'La dirección es requerida.',
            'address.string' => 'La dirección no tiene un formato válido.',
            'phone.required' => 'El telefóno es requerido',
            'quantity_people.required' => 'La cantidad de personas es requerida',
            'quantity_tables.required' => 'La cantidad de mesas es requerido.',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya se encuentra registrado'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('message', 'Ha ocurrido un error.');
            $request->session()->flash('alert-type', 'error');

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $branch->update($request->all());

        if ($request->zipcodes) {
            BranchZipCode::where('branch_id', $branch->id)->delete();

            //Guardar códigos postales sucursal
            foreach ($request->zipcodes as $zipcode) {
                if($zipcode){
                    $branch_zipcode = new BranchZipCode();
                    $branch_zipcode->zipcode = $zipcode;
                    $branch_zipcode->branch_id = $branch->id;
                    $branch_zipcode->save();
                }
            }
        }

        $request->session()->flash('message', 'Sucursal actualizada con éxito.');
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
        $owner = OrderDetail::where('branch_id', $request->id)->first();

        if ($owner) {
            $request->session()->flash('message', 'La sucursal no se puede eliminar porque tiene registros asociados.');
            $request->session()->flash('alert-type', 'error');

            return redirect()->back();
        }

        Branch::destroy($request->id);

        $request->session()->flash('message', 'Sucursal eliminada exitosamente.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
    }
}
