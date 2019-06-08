<?php

namespace App\Services;

use App\Contracts\Services\UserService as UserServiceContract;
use App\Contracts\Repositories\UserRepository;
use App\Entities\User;
use App\Exceptions\NotFoundException;
use App\Services\DTO\UserData;

class UserService implements UserServiceContract
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function retrieveUser(string $userName): User
    {
        $user = $this->userRepository->getByName($userName);

        if (is_null($user)) {
            throw new NotFoundException('User ' . $userName . ' not found!');
        }

        return $user;
    }

    public function createUser(UserData $userData): User
    {
        if (! $userData->name) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        $user = $this->userRepository->getByName($userData->name);

        if (! is_null($user)) {
            throw new \InvalidArgumentException('User already exists');
        }

        $user = new User;
        $user->name = $userData->name;

        return $this->userRepository->save($user);
    }
}
