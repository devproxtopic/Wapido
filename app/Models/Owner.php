<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name', 'email', 'logo', 'phone', 'sliders', 'description', 'slug', 'user_id'
    ];
}
