<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\MyJob;
use App\Jobs\Failed;

class QueueController extends Controller
{
    public function asyncTask(Request $request) {
        MyJob::dispatch(
            $request->input('data'),
            $request->input('complexity')
        )->onConnection('beanstalkd');

        return response()->json([
            "success" => true
        ], 200);
    }

    public function syncTask(Request $request) {
        MyJob::dispatch(
            $request->input('data'),
            $request->input('complexity')
        )->onConnection('sync');

        return response()->json([
            "success" => true
        ], 200);
    }

    public function failJob() {
        Failed::dispatch();

        return response()->json([], 200);
    }
}
