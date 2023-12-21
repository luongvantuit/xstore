<?php

namespace XStore;

use XStore\X\Env;

class Configs
{

    private function __construct()
    {
    }

    public static function getMysqlInfo(): array
    {
        $host = Env::getEnv("MYSQL_HOST", "127.0.0.1");
        $port = Env::getEnv("MYSQL_PORT", 3306);
        $username = Env::getEnv("MYSQL_USERNAME", "admin");
        $password = Env::getEnv("MYSQL_PASSWORD", "adminpw");
        $dbname = Env::getEnv("MYSQL_DATABASE", "db");
        return array(
            "host" => $host,
            "port" => $port,
            "user" => $username,
            "password" => $password,
            "dbname" => $dbname,
        );
    }

    public static function getSecretKey(): string
    {
        $key = Env::getEnv("JWT_SECRET_KEY", "secret");
        return $key;
    }
}
