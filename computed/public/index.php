<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Kernel\Router;
use Slim\Controllers\Employee;

(new Router(Employee::class, "/employee"))
    ->register("GET", "/user", "getUsers")
    ->run();
