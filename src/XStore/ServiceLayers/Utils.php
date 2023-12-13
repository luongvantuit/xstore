<?php

namespace XStore\ServiceLayers;

use Firebase\JWT\JWT;

use function XStore\get_secret_key;

require_once __DIR__ . "/../Configs.php";

function encodePassword(string $password): string
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

function generateJWT(array $payload): string
{
    return JWT::encode($payload, get_secret_key(), 'HS256');
}
