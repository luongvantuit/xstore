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

    public function set_email(string $email): void
    {
        $this->email = $email;
    }

    public function get_email(): string
    {
        return $this->email;
    }

    public function set_password(string $password): void
    {
        $this->password = $password;
    }

    public function get_password(): string
    {
        return $this->password;
    }

    public function set_username(string $username): void
    {
        $this->username = $username;
    }

    public function get_username(): string
    {
        return $this->username;
    }
}
