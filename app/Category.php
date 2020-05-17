<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'unit_id', 'measure', 'description', 'img'
    ];

    public function unit(){
        return $this->belongsTo('App\Unit');
    }

    // get measures by id
    static function measures($id)
    {
        return json_decode(self::find($id)->measure);
    }

    public function items(){
        return $this->hasMany('App\Item');
    }
}
