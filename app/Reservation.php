<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function owner()
    {
        return $this->belongsTo('App\Models\Owner');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
}
