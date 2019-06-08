<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageEvent;
use Illuminate\Events\Dispatcher;
use Illuminate\Contracts\Broadcasting\Broadcaster;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function send(Request $request) {
        $user = Auth::user();

        MessageEvent::broadcast($user, $request->input('message'))
            ->toOthers();

        return response()->json([], 200);
    }
}
