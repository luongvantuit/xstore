<?php

use XStore\X\Path;
use XStore\X\Response\HttpStatusCode;

require_once __DIR__ . "/../vendor/autoload.php";

# Path mapping
$path_mapping = array(
    "/" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/Home.php",
    "/register" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/Register.php",
    "/login" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/Login.php",
    "/orders" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/Orders.php",
    "/carts" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/Carts.php",
    "/products" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/Products.php",
);

# Inject to target
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (Path::has($path_mapping, $url_path)) {
    include_once Path::target($path_mapping, $url_path);
} else {
    http_response_code(HttpStatusCode::NOT_FOUND);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'not found']);
}