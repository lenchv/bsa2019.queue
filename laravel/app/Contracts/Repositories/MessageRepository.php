<?php

namespace App\Contracts\Repositories;

use App\Entities\Message;
use Illuminate\Support\Collection;

interface MessageRepository
{
    public function getAll() : Collection;

    public function save(Message $message) : Message;
}
