<?php

namespace XStore;

use function XStore\X\get_env;

require_once __DIR__ . "/X/Env.php";

function get_mysql_info(): array
{
    $host = get_env("MYSQL_HOST", "127.0.0.1");
    $port = get_env("MYSQL_PORT", 3306);
    $username = get_env("MYSQL_USERNAME", "admin");
    $password = get_env("MYSQL_PASSWORD", "adminpw");
    $dbname = get_env("MYSQL_DATABASE", "db");
    return array(
        "host" => $host,
        "port" => $port,
        "user" => $username,
        "password" => $password,
        "dbname" => $dbname,
    );
}
