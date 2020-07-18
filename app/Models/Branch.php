<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'owner_id', 'country_id', 'state_id', 'city_id', 'location_id', 'name', 'address',
        'phone', 'ubication_google_maps', 'quantity_people', 'quantity_tables', 'email'
    ];

    public function zipcodes()
    {
        return $this->hasMany('App\Models\BranchZipCode');
    }

    /**
     * SCOPES
     */

    public function scopeGetByZipcode($query, $reqZipcode)
    {
        if ($reqZipcode) {
            $query->whereHas('zipcodes', function ($q) use ($reqZipcode) {
                $q->where('zipcode', 'like', "%$reqZipcode%");
            });
        }

        return $query;
    }
}
