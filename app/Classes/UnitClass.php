<?php

namespace App\Classes;
use App\Models\Unit;

class UnitClass
{
    public function create($unitData): Unit
    {
        return Unit::create($unitData);
    }

    public function update($id, $unitData): Unit
    {
        $unit = Unit::find($id);
        return $unit->update($unitData);
    }

    public function destroy($id)
    {
        return Unit::destroy($id);
    }
}
