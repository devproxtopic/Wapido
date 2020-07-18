<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id', 'total_amount', 'status_id', 'apply_delivery',
        'payment', 'owner_id', 'number_table', 'confirm_date', 'branch_id'
    ];

    protected $dates = [
        'confirm_date'
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

    /**
     * Scopes
     */

    public function scopeGetDateCreated($query, $reqDateCreated)
    {
        return $reqDateCreated ? $query->whereDate('created_at', $reqDateCreated) : $query;
    }

    public function scopeGetClient($query, $reqClient)
    {
        if ($reqClient) {
            $query->whereHas('client', function ($q) use ($reqClient) {
                $q->where('fullname', 'like', "%$reqClient%")
                ->orWhere('phone', 'like', "%$reqClient%");
            });
        }

        return $query;
    }

    public function scopeGetStatus($query, $reqStatus)
    {
        return $reqStatus ? $query->where('status_id', $reqStatus) : $query;
    }
}
