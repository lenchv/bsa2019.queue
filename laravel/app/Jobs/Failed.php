<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class Failed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $fileName;
    public $fileSystem;

    public function __construct()
    {
        $this->fileSystem = Storage::disk('local');
        $this->fileName = 'faled_at_' . time();
    }

    public function handle()
    {
        $this->fileSystem->append($this->fileName, $this->attempts());

        throw new \Exception('Job is failed!');
    }

    public function failed(\Exception $exception)
    {
        $this->fileSystem->append($this->fileName, $exception->getMessage());
    }
}
