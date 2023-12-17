<?php

namespace XStore\Domains\Commands;


class CreateNewUserCommand extends Command
{
    private string $password;
    private string $username;
    private string $email;

    public function __construct(string $password, string $username, string $email)
    {
        $this->password = $password;
        $this->username = $username;
        $this->email = $email;
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

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
