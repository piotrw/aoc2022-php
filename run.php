<?php

use Tools\AocEngine;

if(!file_exists("vendor/autoload.php")) {
    exit("\e[01;31m /!\\ Application is not installed, please run: composer install ! \e[0m\n");
}

include "vendor/autoload.php";

$config = [
    "year" => 2022,
    "data_dir" => 'data',
];

try {
    $aoc = new AocEngine($argv, $config);
} catch (Exception $e) {
    (new Tools\Output())->error($e->getMessage());
    exit(1);
}

