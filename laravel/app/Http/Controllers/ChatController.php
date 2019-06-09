<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\ChatService;
use App\Services\DTO\MessageDTO;

class ChatController extends Controller
{
    private $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function send(Request $request) {
        try {

            $messageData = new MessageDTO(
                Auth::user(),
                $request->input('message')
            );
            $message = $this->chatService->sendTo($messageData);
    
            return response()->json([], 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getMessages()
    {
        try {
            $messages = $this->chatService->getMessages();
    
            return response()->json($messages, 200);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
