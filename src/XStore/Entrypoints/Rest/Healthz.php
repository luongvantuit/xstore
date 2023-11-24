<?php

use XStore\X\Request\Method;
use XStore\X\Response\HttpStatusCode;

if ($_SERVER[Method::PARAM_NAME] == Method::GET) {
    http_response_code(HttpStatusCode::OK);
    header("Content-Type: application/json");
    echo json_encode(array(
        "message" => "alive"
    ));
}
