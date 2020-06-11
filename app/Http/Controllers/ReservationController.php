<?php

namespace App\Http\Controllers;

use App\Mail\ClientReservationCreate;
use App\Mail\OwnerReservationCreate;
use App\Models\Client;
use App\Models\Owner;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends WebController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = Owner::where('slug', $this->slug)->first();

        $reservations = Reservation::where('owner_id', $owner->id)
        ->orderBy('created_at', 'desc')->paginate(15);
        return view('reservations.index', compact('reservations', 'owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owner = Owner::where('slug', $this->slug)->first();
        return view('reservations.create', compact('owner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $owner = Owner::where('slug', $this->slug)->first();
        $client = Client::where('email', $request->email)->first();

        if(! $client){
            $client = Client::create([
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'owner_id' => $owner->id
            ]);
        }

        $reservation = new Reservation;
        $reservation->client_id = $client->id;
        $reservation->owner_id = $owner->id;
        $reservation->type_table = $request->type_table;
        $reservation->date = $request->date;
        $reservation->start_time = $request->start_time;
        $reservation->end_time = $request->end_time;

        $reservation->save();

        Mail::to($client->email)->send(new ClientReservationCreate($reservation));
        Mail::to($owner->email)->send(new OwnerReservationCreate($reservation));

        $request->session()->flash('message', $reservation->id);
        return redirect()->back();
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
        $reservation = Reservation::find($request->reservation);
        return view('reservations.edit', compact('owner', 'reservation'));
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
        $reservation = Reservation::find($request->reservation);
        $reservation->confirmed = $request->confirmed;

        $reservation->save();

        $request->session()->flash('message', 'Reservación editada con éxito.');
        $request->session()->flash('alert-type', 'success');

        return redirect()->back();
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
