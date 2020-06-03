<?php

namespace App\Classes;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserClass
{
    public function create($userData): User
    {
        return User::create($userData);
    }

    public function update($id, $userData): User
    {
        $user = User::find($id);
        return $user->update($userData);
    }

    public function hashPassword($password)
    {
        return Hash::make($password);
    }
}
