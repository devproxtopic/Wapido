<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id', 'total_amount', 'status_id', 'apply_delivery', 'payment', 'owner_id', 'number_table'
    ];

    public function owner(){
        return $this->belongsTo('App\Models\Owner');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function status(){
        return $this->belongsTo('App\Models\Status');
    }

    public function details(){
        return $this->hasMany('App\Models\OrderDetail');
    }
}
