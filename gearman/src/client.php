<?php
$func = require(__DIR__ . '/func.php');
$asyncFunc = require(__DIR__ . '/asyncFunc.php');
$benchmark = require(__DIR__ . '/benchmark.php');

$testData = "Test data ";

echo PHP_EOL;
$benchmark($asyncFunc, "Asynchronous operation", $testData, 100);
$benchmark($asyncFunc, "Asynchronous operation", $testData, 200);
$benchmark($asyncFunc, "Asynchronous operation", $testData, 500);
$benchmark($asyncFunc, "Asynchronous operation", $testData, 750);

echo PHP_EOL;
$benchmark($func, "Synchronous operation", $testData, 100);
$benchmark($func, "Synchronous operation", $testData, 200);
$benchmark($func, "Synchronous operation", $testData, 500);
$benchmark($func, "Synchronous operation", $testData, 750);
