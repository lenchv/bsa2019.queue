<?php

namespace App\Contracts\Services;

use App\Services\DTO\MessageDTO;
use App\Entities\Message;

interface ChatService
{
    public function sendTo(MessageDTO $message) : Message;

    public function getMessages() : array;
}
