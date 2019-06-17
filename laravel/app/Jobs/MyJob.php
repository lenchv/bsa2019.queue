<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Filesystem\Factory;

class MyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $complexity;

    public function __construct(string $data, int $complexity)
    {
        $this->data = $data;
        $this->complexity = $complexity;
    }

    public function handle(Factory $fs)
    {
        $fileSystem = $fs->disk('local');
        $fileName = time() . ".txt";

        for ($i = 0; $i < $this->complexity; $i++) {
            $fileSystem->append($fileName, $this->data . ' ' . $i);
        }
    }
}
