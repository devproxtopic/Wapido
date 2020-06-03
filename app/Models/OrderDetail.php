<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'item_id', 'quantity', 'unit_price', 'measure'
    ];

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
}
