<?php

namespace App\Classes;
use App\Models\Status;

class StatusClass
{
    public function create($statusData): Status
    {
        return Status::create($statusData);
    }

    public function update($id, $statusData): Status
    {
        $status = Status::find($id);
        return $status->update($statusData);
    }

    public function destroy($id)
    {
        return Status::destroy($id);
    }
}
