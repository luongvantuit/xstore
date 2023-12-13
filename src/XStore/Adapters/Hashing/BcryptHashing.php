<?php

namespace XStore\Adapters\Hashing;


class BcryptHashing extends AbstractHashing
{

    private int $rounds;

    public function __construct(int $rounds = 12)
    {
        $this->rounds = $rounds;
    }

    public function hash(string $v): string
    {
        $options = array([
            "cost" => $this->rounds,
        ]);
        return password_hash($v, PASSWORD_BCRYPT, $options);
    }

    public function compare(string $v, string $hashed): bool
    {
        return password_verify($v, $hashed);
    }
}
