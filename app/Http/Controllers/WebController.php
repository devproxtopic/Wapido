<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    protected $slug = '';

    public function __construct(Request $request)
    {
        $this->slug = $request->slug;
    }

}
