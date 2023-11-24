<?php

namespace XStore\X;

function get_env(string $name, mixed $default_value = null): mixed
{
    $value = getenv($name);
    return $value !== false ? $value : $default_value;
}
