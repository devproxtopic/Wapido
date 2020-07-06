<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'description', 'slug', 'user_id', 'closing_hours',
        'opening_hours', 'category_owner_id', 'days_not_reservation', 'order_enabled',
        'main_digital_enabled', 'reservations_enabled', 'theme',
        'country_id', 'state_id', 'city_id', 'location_id'
    ];

    public function employees(){
        return $this->hasMany('App\Models\Employee');
    }

    public function category(){
        return $this->belongsTo('App\Models\CategoryOwner', 'category_owner_id');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function city(){
        return $this->belongTo('App\Models\City');
    }

    public function location(){
        return $this->belongsTo('App\Models\Location');
    }

    public function foods(){
        return $this->hasMany('App\Models\Food');
    }

    public function tables(){
        return $this->hasMany('App\Models\Table')->orderBy('number');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * SCOPES
     */

    public function scopeGetCategory($query, $reqCategory)
    {
        return $reqCategory ? $query->where('category_owner_id', $reqCategory) : $query;
    }

    public function scopeGetCountry($query, $reqCountry)
    {
        return $reqCountry ? $query->where('country_id', $reqCountry) : $query;
    }

    public function scopeGetState($query, $reqState)
    {
        return $reqState ? $query->where('state_id', $reqState) : $query;
    }

    public function scopeGetCity($query, $reqCity)
    {
        return $reqCity ? $query->where('city_id', $reqCity) : $query;
    }

    public function scopeGetLocation($query, $reqLocation)
    {
        return $reqLocation ? $query->where('location_id', $reqLocation) : $query;
    }

    public function scopeGetTypeFood($query, $reqTypeFood)
    {
        if($reqTypeFood){
            $query->whereHas('foods', function($q) use($reqTypeFood){
                    $q->where('category_food_id', $reqTypeFood);
                });
        }

        return $query;
    }
}
