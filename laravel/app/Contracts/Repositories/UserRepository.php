<?php

namespace App\Contracts\Repositories;

use App\Entities\User;

interface UserRepository
{
    public function getByName(string $userName) : ?User;
    
    public function getById(int $userId) : ?User;

    public function save(User $user) : User;
}
