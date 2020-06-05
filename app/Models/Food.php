<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function category(){
        return $this->belongsTo('App\Models\CategoryFood', 'category_food_id');
    }
}
