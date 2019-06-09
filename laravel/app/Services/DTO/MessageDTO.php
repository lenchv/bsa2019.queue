<?php

namespace App\Services\DTO;

use App\Entities\User;

class MessageDTO
{
    public $user;
    public $message;

    public function __construct(User $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }
}
