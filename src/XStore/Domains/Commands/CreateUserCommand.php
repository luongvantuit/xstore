<?php

namespace XStore\Domains\Commands;


class CreateUserCommand extends Command
{
    private string $password;
    private string $username;
    private string $email;

    public function __construct(string $password, string $username, string $email)
    {
        $this->set_password($password);
        $this->set_username($username);
        $this->set_email($email);
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

    public function set_email(string $email): void
    {
        $this->email = $email;
    }

    public function get_email(): string
    {
        return $this->email;
    }
}
