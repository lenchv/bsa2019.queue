<?php
$func = require(__DIR__ . '/func.php');
$asyncFunc = require(__DIR__ . '/asyncFunc.php');
$benchmark = require(__DIR__ . '/benchmark.php');

$testData = "Test data ";

echo PHP_EOL;
$benchmark($asyncFunc, "Asynchronous operation", $testData, 100000);
$benchmark($asyncFunc, "Asynchronous operation", $testData, 200000);
$benchmark($asyncFunc, "Asynchronous operation", $testData, 500000);
$benchmark($asyncFunc, "Asynchronous operation", $testData, 750000);

echo PHP_EOL;
$benchmark($func, "Synchronous operation", $testData, 100000);
$benchmark($func, "Synchronous operation", $testData, 200000);
$benchmark($func, "Synchronous operation", $testData, 500000);
$benchmark($func, "Synchronous operation", $testData, 750000);
