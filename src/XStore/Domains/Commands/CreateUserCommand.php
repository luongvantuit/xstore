<?php

namespace XStore\Domains\Commands;


class CreateUserCommand extends Command
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function set_password(string $password): void
    {
        $this->password = $password;
    }

    public function get_password(): string
    {
        return $this->password;
    }
}
