<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Controllers\Authentic;
use Slim\Controllers\History;
use Slim\Controllers\Level;
use Slim\Controllers\Product;
use Slim\Controllers\Provider;
use Slim\Controllers\User;
use Slim\Kernel\Router;
use Slim\Middlewares\Access;

(new Router(Authentic::class, "/authentic"))
    ->addMiddleware(false, Access::class)
    ->register("GET", "/session", "getSession")
    ->register("POST", "/session", "postSession")
    ->register("DELETE", "/session", "deleteSession")
    ->channel();

(new Router(History::class, "/history"))
    ->addMiddleware(false, Access::class)
    ->register("GET", "", "getOne")
    ->register("GET", "/all", "getAll")
    ->channel();

(new Router(User::class, "/user"))
    ->addMiddleware(false, Access::class)
    ->register("GET", "", "getOne")
    ->register("POST", "", "postOne")
    ->register("PUT", "", "putOne")
    ->register("DELETE", "", "deleteOne")
    ->register("GET", "/all", "getAll")
    ->channel();

(new Router(Product::class, "/product"))
    ->addMiddleware(false, Access::class)
    ->register("GET", "", "getOne")
    ->register("POST", "", "postOne")
    ->register("PUT", "", "putOne")
    ->register("DELETE", "", "deleteOne")
    ->register("GET", "/all", "getAll")
    ->channel();

(new Router(Provider::class, "/provider"))
    ->addMiddleware(false, Access::class)
    ->register("GET", "", "getOne")
    ->register("POST", "", "postOne")
    ->register("PUT", "", "putOne")
    ->register("DELETE", "", "deleteOne")
    ->register("GET", "/all", "getAll")
    ->channel();

(new Router(Level::class, "/level"))
    ->addMiddleware(false, Access::class)
    ->register("GET", "", "getOne")
    ->register("POST", "", "postOne")
    ->register("PUT", "", "putOne")
    ->register("DELETE", "", "deleteOne")
    ->register("GET", "/all", "getAll")
    ->channel();

Router::run();
