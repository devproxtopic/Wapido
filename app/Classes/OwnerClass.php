<?php

namespace App\Classes;
use App\Models\Owner;

class OwnerClass
{
    public function create($ownerData): Owner
    {
        return Owner::create($ownerData);
    }

    public function update($id, $ownerData): Owner
    {
        $owner = Owner::find($id);
        return $owner->update($ownerData);
    }

    public function destroy($id)
    {
        return Owner::destroy($id);
    }

    public function identityBySlug($slug)
    {
        return Owner::where('slug', $slug)->first();
    }
}
