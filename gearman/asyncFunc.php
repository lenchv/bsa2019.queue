<?php

$config = require('./config.php');

$gmClient = new GearmanClient();

$gmClient->addServer(
    $config["host"],
    $config["port"]
);

return function ($content, $complexity) use ($gmClient) {
    $gmClient->doBackground("func", json_encode([
        "content" => $content,
        "complexity" => $complexity
    ]));

    return $gmClient->returnCode() === GEARMAN_SUCCESS;
};
