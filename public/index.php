<?php
require_once "../libraries/Path.php";

use Libraries\PathCompare\Path;


# Path mapping
$pathMapping = [
    "/" => "../views/Home.php",
    "/register" => "../views/Register.php",
    "/login" => "../views/Login.php",
    "/orders" => "../views/Orders.php",
];

# Inject to target
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$target = Path::target($pathMapping, $url_path);
if ($target != "") {
    include $target;
} else {
    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'not found']);
}

?>