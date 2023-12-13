<?php

namespace XStore\Domains\Commands;

class LoginCommand extends Command
{
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->set_email($email);
        $this->set_password($password);
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
}
