<?php

namespace XStore\Domains\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User extends BaseModel
{

    #[ORM\Column(name: "username", type: 'string')]
    private string $username;

    #[ORM\Column(name: "email", type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(name: "password", type: 'string')]
    private string $password;


    public function __construct(string $password, string $username, string $email)
    {
        parent::__construct();
        $this->password = $password;
        $this->username = $username;
        $this->email = $email;
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
