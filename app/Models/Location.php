<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'city_id', 'name', 'latitude', 'longitude'
    ];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
