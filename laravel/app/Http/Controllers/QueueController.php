<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\Example1 as Example1;
use App\Jobs\Failed;

class QueueController extends Controller
{
    public function asyncTask(Request $request) {
        Example1::dispatch(
            $request->input('data'),
            $request->input('complexity')
        )->onConnection('beanstalkd');

        return response()->json([
            "success" => true
        ], 200);
    }

    public function syncTask(Request $request) {
        Example1::dispatch(
            $request->input('data'),
            $request->input('complexity')
        )->onConnection('sync');

        return response()->json([
            "success" => true
        ], 200);
    }

    public function failJob() {
        Failed::dispatch();
    }
}
