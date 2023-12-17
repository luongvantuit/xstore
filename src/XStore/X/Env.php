<?php

namespace XStore\X;

class Env
{

    private function __construct()
    {
    }

    public static function getEnv(string $name, mixed $defaultValue = null): mixed
    {
        $value = getenv($name);
        return $value !== false ? $value : $defaultValue;
    }
}
