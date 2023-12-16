<?php

namespace XStore\Domains\Commands;

class UserLoginCommand extends Command
{
    private string $identify;
    private string $password;

    public function __construct(string $identify, string $password)
    {
        $this->identify = $identify;
        $this->password = $password;
    }

    public function set_identify(string $identify): void
    {
        $this->identify = $identify;
    }

    public function get_identify(): string
    {
        return $this->identify;
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
