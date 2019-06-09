<?php

namespace App\Services;

use App\Contracts\Services\ChatService as ChatSeviceContract;
use App\Contracts\Repositories\MessageRepository;
use App\Services\DTO\MessageDTO;
use App\Events\MessageEvent;
use App\Entities\Message;

class ChatService implements ChatSeviceContract
{
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function getMessages(): array
    {
        $messages = $this->messageRepository->getAll();

        return $messages->map(function (Message $message) {
            return [
                "message" => $message->message,
                "author" => $message->author->name
            ];
        })->toArray();
    }

    public function sendTo(MessageDTO $messageData) : Message
    {
        $message = new Message();
        $message->message = $messageData->message;
        $message->author_id = $messageData->user->id;

        $message = $this->messageRepository->save($message);

        MessageEvent::broadcast($message)->toOthers();

        return $message;
    }
}
