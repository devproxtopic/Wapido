<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Table;
use Illuminate\Http\Request;

use QrCode;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $owner = Owner::where('slug', $slug)->first();
        $tables = Table::where('owner_id', $owner->id)->paginate(15);

        return view('tables.index', compact('owner', 'tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $owner = Owner::where('slug', $slug)->first();

        return view('tables.create', compact('owner'));
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
        $tables = Table::where('owner_id', $owner->id)->orderBy('number', 'desc')->first();

        if($tables){
            $i = $tables->number + 1;
        } else {
            $i = 1;
        }

        $limit = $i + $request->quantity;

        $micarpeta = 'storage/owners/' . $owner->id . '/tables/';

        if (!file_exists($micarpeta)) {
            mkdir($micarpeta, 0777, true);
        }

        for($i; $i < $limit; $i++){
            \QrCode::format('png')->size(300)->generate(url($owner->slug . '?table=' . $i), 'storage/owners/' . $owner->id . '/tables/' . $i . '.png');
            $table = new Table();
            $table->owner_id = $owner->id;
            $table->number = $i;
            $table->ubication = $request->ubication;
            $table->type = $request->type;
            $table->qr = "storage/owners/" . $owner->id . "/tables/" . $i . '.png';
            $table->save();
        }

        $request->session()->flash('message', 'Mesas creadas con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect('owners/' . $request->slug . '/tables');
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
        $table = Table::find($id);

        return view('tables.edit', compact('owner', 'table'));
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
        $table = Table::find($id);
        $table->ubication = $request->ubication;
        $table->type = $request->type;
        $table->save();

        $request->session()->flash('message', 'Mesa actualizada con éxito.');
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
        Table::find($id);

        session()->flash('message', 'Mesa eliminada con éxito.');
        session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    public function downloadQr($slug, $id){
        $table = Table::find($id);

        if($table->qr){
            return response()->download($table->qr);
        }

        session()->flash('message', 'Ha ocurrido un error.');
        session()->flash('alert-type', 'error');

        return redirect()->back();
    }
}
