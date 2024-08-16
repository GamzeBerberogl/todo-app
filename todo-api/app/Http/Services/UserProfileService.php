<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfileService
{
    public function getUserProfile($userId)
    {
        return User::findOrFail($userId);
    }

    public function updateUserProfile($userId, array $data): User
    {
        $user = User::findOrFail($userId);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function changePassword($userId, array $data): User
    {
        $user = User::findOrFail($userId);

        //mevcut şifre ve yeni şifre
        if (!Hash::check($data['current_password'], $user->password)) {
            throw new \Exception('Mevcut şifre yanlış.');
        }
        $user->password = bcrypt($data['new_password']);
        $user->save();

        return $user;
    }
}

