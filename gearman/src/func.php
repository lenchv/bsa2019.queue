<?php

$count = 0;

return function ($data, $complexity) use (&$count) {
    $dir = __DIR__ . '/.data/';

    if (!file_exists($dir)) {
        mkdir($dir);
    }

    $fileName = $dir . time() . '.txt';
    
    for ($i = 0; $i < $complexity; $i++) {
        file_put_contents(
            $fileName,
            $data . " $i" . PHP_EOL,
            FILE_APPEND
        );
    }
};
