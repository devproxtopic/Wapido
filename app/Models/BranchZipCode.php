<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchZipCode extends Model
{
    protected $fillable = [
        'branch_id', 'zipcode'
    ];
}
