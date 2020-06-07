<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function owner(){
        return $this->belongsTo('App\Models\Owner');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
