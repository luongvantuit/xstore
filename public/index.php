<?php

use XStore\X\Path;
use XStore\X\Response\HttpResponse;
use XStore\X\Response\HttpResponseJson;
use XStore\X\Response\HttpStatusCode;

require_once __DIR__ . "/../vendor/autoload.php";

# Path mapping
$path_mapping = array(
    # MVC App
    "/" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Home.php",
    "/register" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Register.php",
    "/login" => __DIR__ . "/../src/XStore/Entrypoints/Mvc/App/Login.php",
    # MVC Admin
    # API 
    "/api/healthz" => __DIR__ . "/../src/XStore/Entrypoints/Rest/HealthzController.php",
    # API App
    "/api/login" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/LoginController.php",
    "/api/register" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/RegisterController.php",
    "/api/products" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/ProductsController.php",
    # API Admin
);

# Inject to target
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (Path::has($path_mapping, $url_path)) {
    // define("PATH_ORIGIN", Path::origin($path_mapping, $url_path), true);
    include_once Path::target($path_mapping, $url_path);
} else {
    $response = new HttpResponse();
    $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
        new HttpResponseJson(success: false, message: "not found!")
    )->build();
}
