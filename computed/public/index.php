<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Controllers\Authentic;
use Slim\Controllers\Product;
use Slim\Kernel\Router;
use Slim\Middlewares\Access;

(new Router(Authentic::class, "/authentic"))
    ->addMiddleware(false, Access::class)
    ->register("GET", "/session", "getSession")
    ->register("POST", "/session", "postSession")
    ->register("DELETE", "/session", "deleteSession")
    ->run();

(new Router(Product::class, "/product"))
    ->addMiddleware(false, Access::class)
    ->register("GET", "/user", "getUser")
    ->register("GET", "/users", "getUsers")
    ->run();
