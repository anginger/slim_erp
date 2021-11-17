<?php
declare(strict_types=1);

require __DIR__ . "/Rectangle.php";

$rectangle = new Rectangle(1, 2);
echo $rectangle->perimeter() . PHP_EOL;
echo $rectangle->area() . PHP_EOL;
var_dump($rectangle);
