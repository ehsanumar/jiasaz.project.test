<?php

define('BASE_PATH', realpath(__DIR__));
require_once __DIR__ . '/vendor/autoload.php';
use App\Routes\Router;

Router::route();