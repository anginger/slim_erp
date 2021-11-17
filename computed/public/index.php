<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Gle\Controllers\Shape;
use Gle\Kernel\Router;

(new Router(Shape::class, "/"))
    ->register("GET", "/rectangle", "getRectangle")
    ->run();
