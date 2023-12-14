<?php

use XStore\X\Path;
use XStore\X\Response\HttpStatusCode;

require_once __DIR__ . "/../vendor/autoload.php";


# Path mapping
$path_mapping = array(
    # MVC App
    "/" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Home.php",
    "/register" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Register.php",
    "/login" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Login.php",
    "/products" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Products.php",
    "/shops" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Shops.php",
    "/contact" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Contact.php",
    # MVC Admin
    # API 
    "/api/healthz" => __DIR__ . "/../src/XStore/Entrypoints/Rest/Healthz.php",
    # API App
    # API Admin
    

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
