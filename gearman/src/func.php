<?php

$count = 0;

return function ($data, $complexity) use (&$count) {
    $fileName = __DIR__ . '/.data/' . time() . '.txt';
    
    for ($i = 0; $i < $complexity; $i++) {
        file_put_contents(
            $fileName,
            $data . " $i" . PHP_EOL,
            FILE_APPEND
        );
    }
};
