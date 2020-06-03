<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id', 'name', 'price', 'description', 'img', 'owner_id'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
