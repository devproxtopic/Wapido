<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id', 'name', 'price', 'description', 'img'
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
