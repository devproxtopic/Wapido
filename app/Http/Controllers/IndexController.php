<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Owner;
use App\Promotion;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($slug, Request $request)
    {
        $owner = Owner::where('slug', $slug)->first();

        if(! $owner){
            return abort(404);
        }

        $promotions = Promotion::where('owner_id', $owner->id)->get();
        $categories = Category::where('owner_id', $owner->id)->get();
        $clients = Client::where('owner_id', $owner->id)->get();
        $client = null;
        $order = null;

        return view('index', compact('categories', 'clients', 'client', 'order','owner','promotions'));
    }
}
