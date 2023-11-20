<?php

# MVC mapping
$viewsMapping = array(
    "/avatars" => "../views/Avatars.php",
);

# Rest API mapping
$apiMapping = array();

$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


?>