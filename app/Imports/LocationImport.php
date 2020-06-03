<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Location;
use Maatwebsite\Excel\Concerns\ToModel;

class LocationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0]){
            return new Location([
                'city_id' => City::where('name', 'like', "%$row[1]%")->first()->id,
                'name' => $row[0]
            ]);
        }
    }
}
