<?php

namespace XStore\ServiceLayers;

use Firebase\JWT\JWT;

use function XStore\get_secret_key;

require_once __DIR__ . "/../Configs.php";

// function generateJWT(array $payload): string
// {
//     return JWT::encode($payload, get_secret_key(), 'HS256');
// }
