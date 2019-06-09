<?php

namespace App\Repositories;

use App\Contracts\Repositories\MessageRepository as MessageRepositoryContract;
use App\Entities\Message;
use Illuminate\Support\Collection;

class MessageRepository implements MessageRepositoryContract
{
    public function getAll() : Collection
    {
        return Message::with('author')->get();
    }

    public function save(Message $message) : Message
    {
        $message->save();

        return $message;
    }
}
