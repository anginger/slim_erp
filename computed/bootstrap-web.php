<?php
declare (strict_types=1);

require __DIR__ . "/Rectangle.php";

$width = floatval($_GET['width'] ?? 0);
$height = floatval($_GET['height'] ?? 0);

$path = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];

$mutux = [];

$mutux[] = function () {
    $rectangle = new Rectangle($width, $height);
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([$rectangle, $_SERVER]);
};
