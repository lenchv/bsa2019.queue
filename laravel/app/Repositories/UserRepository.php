<?php

namespace App\Repositories;

use App\Entities\User;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function getByName(string $userName) : ?User
    {
        return User::where('name', $userName)->first();
    }

    public function getById(int $userId): ?User
    {
        return Uesr::find($userId);
    }

    public function save(User $user) : User
    {
        $user->save();

        return $user;
    }
}
