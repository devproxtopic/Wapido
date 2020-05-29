<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id', 'total_amount', 'status_id', 'apply_delivery', 'payment', 'owner_id'
    ];

    public function owner(){
        return $this->belongsTo('App\Owner');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function details(){
        return $this->hasMany('App\OrderDetail');
    }
}
