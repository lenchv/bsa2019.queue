<?php

echo "Worker started..." . PHP_EOL;

$config = require(__DIR__ . '/config.php');
$func = require(__DIR__ . '/func.php');
$benchmark = require(__DIR__ . '/benchmark.php');
$gmWorker = new GearmanWorker();

$gmWorker->addServer(
    $config["host"],
    $config["port"]
);

$gmWorker->addFunction("func", function (GearmanJob $job) use (&$count, $func, $benchmark) {
    $data = json_decode($job->workload());

    $benchmark(
        $func,
        "Job #{{$job->unique()}}",
        $data->content,
        $data->complexity
    );

    $count++;
});

while($gmWorker->work())
{
    if ($gmWorker->returnCode() !== GEARMAN_SUCCESS) {
        echo "return_code: " . $gmWorker->returnCode() . PHP_EOL;
        break;
    }
}
