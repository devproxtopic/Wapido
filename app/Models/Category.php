<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'unit_id', 'measure', 'description', 'img', 'owner_id'
    ];

    public function unit(){
        return $this->belongsTo('App\Models\Unit');
    }

    // get measures by id
    static function measures($id)
    {
        return json_decode(self::find($id)->measure);
    }

    public function items(){
        return $this->hasMany('App\Models\Item');
    }
}
