<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageEvent;
use Illuminate\Events\Dispatcher;

class ChatController extends Controller
{
    private $eventDispatcher;

    public function __construct(Dispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function send(Request $request) {
        $this->eventDispatcher->dispatch(new MessageEvent(
            $request->input('message')
        ));

        return response()->json([], 200);
    }
}
