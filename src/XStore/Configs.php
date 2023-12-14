<?php

namespace XStore;

use XStore\X\Env;

class Configs
{

    private function __construct()
    {
        error_log("init " . Configs::class, LOG_INFO);
    }

    public static function get_mysql_info(): array
    {
        $host = Env::get_env("MYSQL_HOST", "127.0.0.1");
        $port = Env::get_env("MYSQL_PORT", 3306);
        $username = Env::get_env("MYSQL_USERNAME", "admin");
        $password = Env::get_env("MYSQL_PASSWORD", "adminpw");
        $dbname = Env::get_env("MYSQL_DATABASE", "db");
        return array(
            "host" => $host,
            "port" => $port,
            "user" => $username,
            "password" => $password,
            "dbname" => $dbname,
        );
    }

    public static function get_secret_key(): string
    {
        $key = Env::get_env("JWT_SECRET_KEY", "secret");
        return $key;
    }
}
