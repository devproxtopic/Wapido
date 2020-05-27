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
    public function __invoke(Request $request)
    {
        $categories = Category::all();
        $clients = Client::all();
        $client = null;
        $order = null;
        $owner = Owner::find(1);
        $promotions = Promotion::all();

        return view('index', compact('categories', 'clients', 'client', 'order','owner','promotions'));
    }
}
