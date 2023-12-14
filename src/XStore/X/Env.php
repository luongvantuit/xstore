<?php

namespace XStore\X;

class Env
{

    private function __construct()
    {
    }

    public static function get_env(string $name, mixed $default_value = null): mixed
    {
        $value = getenv($name);
        return $value !== false ? $value : $default_value;
    }
}
