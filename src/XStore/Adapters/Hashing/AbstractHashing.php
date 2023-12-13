<?php

namespace XStore\Adapters\Hashing;

abstract class AbstractHashing
{
    abstract function hash(string $v): string;

    abstract function compare(string $v, string $hashed): bool;
}
