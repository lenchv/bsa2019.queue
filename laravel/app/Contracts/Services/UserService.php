<?php

namespace App\Contracts\Services;

use App\Entities\User;
use App\Services\DTO\UserData;

interface UserService
{
    public function retrieveUser(string $userName): User;

    public function createUser(UserData $data): User;
}
