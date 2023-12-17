<?php

namespace XStore\Domains\Commands;


class CreateNewAdminCommand extends Command
{
    private string $username;

    private string|null $email;

    private string $password;

    public function __construct(string $username, string $password, string $email = null)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
