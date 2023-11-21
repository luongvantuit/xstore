<?php
require_once __DIR__ . "/../libraries/Path.php";
require_once __DIR__ . "/../libraries/HttpResponseCode.php";


# Path mapping
$path_mapping = array(
    "/" => __DIR__ . "/../views/Home.php",
    "/register" => __DIR__ . "/../views/Register.php",
    "/login" => __DIR__ . "/../views/Login.php",
    "/orders" => __DIR__ . "/../views/Orders.php",
    "/carts" => __DIR__ . "/../views/Carts.php",
    "/products" => __DIR__ . "/../views/Products.php",
);

# Inject to target
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (Path::has($path_mapping, $url_path)) {
    include Path::target($path_mapping, $url_path);
} else {
    http_response_code(HttpResponseCode::NOT_FOUND);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'not found']);
}