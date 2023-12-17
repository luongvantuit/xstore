<?php


namespace XStore\Domains\Commands;


class InitialAdminCommand extends Command
{

    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
