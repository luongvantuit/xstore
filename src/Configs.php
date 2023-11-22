<?php

function get_mysql_info(): array
{
    $hostname = getenv("MYSQL_HOSTNAME") === false  ? "127.0.0.1" :  getenv("MYSQL_HOSTNAME");
    $port = getenv("MYSQL_PORT") === false ? 3306 : getenv("MYSQL_PORT");
    $username = getenv("MYSQL_USERNAME") === false ? "admin" : getenv("MYSQL_USERNAME");
    $password = getenv("MYSQL_PASSWORD") === false ? "adminpw" : getenv("MYSQL_PASSWORD");
    $database = getenv("MYSQL_DATABASE") === false ? "db" : getenv("MYSQL_DATABASE");
    return array(
        "hostname" => $hostname,
        "port" => $port,
        "username" => $username,
        "password" => $password,
        "database" => $database,
    );
}
