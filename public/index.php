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
    "/api/profiles" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/ProfilesController.php",
    "/api/orders" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/OrdersController.php",
    "/api/products" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/ProductsController.php",
    "/api/users" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/UsersController.php",
    "/api/cart" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/CartController.php",
    "/api/cart-product" => __DIR__ . "/../src/XStore/Entrypoints/Rest/App/CartProductController.php",
    # API Admin
    "/api/admins" => __DIR__ . "/../src/XStore/Entrypoints/Rest/Admin/AdminController.php",
    "/api/admin/login" => __DIR__ . "/../src/XStore/Entrypoints/Rest/Admin/LoginController.php",
    "/api/admin/orders" => __DIR__ . "/../src/XStore/Entrypoints/Rest/Admin/OrdersController.php",
    "/api/admin/products" => __DIR__ . "/../src/XStore/Entrypoints/Rest/Admin/ProductsController.php",
    "/api/admin/users" => __DIR__ . "/../src/XStore/Entrypoints/Rest/Admin/UsersController.php",
);

# Inject to target
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (Path::has($path_mapping, $url_path)) {
    define("PATH_ORIGIN", Path::origin($path_mapping, $url_path));
    include_once Path::target($path_mapping, $url_path);
} else {
    $response = new HttpResponse();
    $response->statusCode(HttpStatusCode::NOT_FOUND)->json(
        new HttpResponseJson(success: false, message: "not found!")
    )->build();
}
