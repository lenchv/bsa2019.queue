<?php

return function ($func, $label, $content, $complexity) {
    $startTime = time();
    
    echo PHP_EOL;
    echo $label . PHP_EOL;
    echo "Complextiy {$complexity} operations" . PHP_EOL;

    $func($content, $complexity);

    $finishTime = time();
    echo "Duration: " . ($finishTime - $startTime) . " sec." . PHP_EOL;
};
