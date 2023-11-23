<?php

use Response\HttpStatusCode;
use X\Path;

require_once __DIR__ . "/../autoload.php";
require_once __DIR__ . "/../src/Configs.php";

$dir_views = __DIR__ . "/../src/Entrypoints/Mvc/";

$mysql_info = get_mysql_info();
$conn = call_user_func_array('mysqli_connect', $mysql_info);
if (!$conn && $conn->connect_errno) {
    exit();
}
$conn->autocommit(FALSE);

# Path mapping
$path_mapping = array(
    "/" => $dir_views . "Home.php",
    "/register" => $dir_views . "Register.php",
    "/login" => $dir_views . "Login.php",
    "/orders" => $dir_views . "Orders.php",
    "/carts" => $dir_views . "Carts.php",
    "/products" => $dir_views . "Products.php",
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