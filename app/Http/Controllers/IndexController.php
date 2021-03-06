<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Owner;
use App\Models\Promotion;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $owner = Owner::where('slug', $request->slug)->first();

        if(! $owner){
            return abort(404);
        }

        $promotions = Promotion::where('owner_id', $owner->id)->get();
        $categories = Category::where('owner_id', $owner->id)->get();
        $clients = Client::where('owner_id', $owner->id)->get();
        $client = null;
        $order = null;

        $number_table = $request->table ? $request->table : null;
        return view('index', compact('categories', 'clients', 'client', 'order','owner','promotions', 'number_table'));
    }
}
