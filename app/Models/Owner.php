<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name', 'email', 'logo', 'phone', 'sliders', 'description', 'slug', 'user_id'
    ];

    public function employees(){
        return $this->hasMany('App\Models\Employee');
    }

    public function category(){
        return $this->belongsTo('App\Models\CategoryOwner');
    }
}
