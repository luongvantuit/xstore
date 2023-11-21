<?php

use Response\HttpStatusCode;
use X\Path;

require_once __DIR__ . "/../autoload.php";

$path_views = __DIR__ . "/../src/Entrypoints/Mvc/";

# Path mapping
$path_mapping = array(
    "/" => $path_views . "Home.php",
    "/register" => $path_views . "Register.php",
    "/login" => $path_views . "Login.php",
    "/orders" => $path_views . "Orders.php",
    "/carts" => $path_views . "Carts.php",
    "/products" => $path_views . "Products.php",
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