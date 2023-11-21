<?php
require_once "../libraries/Path.php";
require_once "../libraries/HttpResponseCode.php";

use Libraries\HttpResponseCode\HttpResponseCode;
use Libraries\PathCompare\Path;


# Path mapping
$path_mapping = array(
    "/" => "../views/Home.php",
    "/register" => "../views/Register.php",
    "/login" => "../views/Login.php",
    "/orders" => "../views/Orders.php",
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
