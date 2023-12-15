<?php

namespace XStore\X\Jw;

abstract class AbstractJwt
{

    abstract function encode(array $payload): string;

    abstract function decode(string $jwt): array;
}
