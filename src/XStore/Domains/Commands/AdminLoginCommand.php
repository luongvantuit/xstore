<?php


namespace XStore\Domains\Commands;

class AdminLoginCommand extends Command
{
    private string $identify;
    private string $password;

    public function __construct(string $identify, string $password)
    {
        $this->identify = $identify;
        $this->password = $password;
    }

    public function setIdentify(string $identify): void
    {
        $this->identify = $identify;
    }

    public function getIdentify(): string
    {
        return $this->identify;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
