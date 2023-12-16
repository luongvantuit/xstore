<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'admins')]
class Admin extends BaseModel
{
    #[ORM\Column(name: "username", type: 'string', unique: true)]
    private string $username;

    #[ORM\Column(name: "email", type: 'string', nullable: true)]
    private string|null $email;

    #[ORM\Column(name: "password", type: 'string')]
    private string $password;

    #[ORM\Column(name: "is_root", type: 'string')]
    private bool $is_root = false;

    public function __construct(string $username, string $password, string $email = null, bool $is_root = false)
    {
        parent::__construct();
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->is_root = $is_root;
    }

    public function set_email(string $email): void
    {
        $this->email = $email;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_email(): string|null
    {
        return $this->email;
    }

    public function set_password(string $password): void
    {
        $this->password = $password;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_password(): string
    {
        return $this->password;
    }

    public function set_username(string $username): void
    {
        $this->username = $username;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_username(): string
    {
        return $this->username;
    }

    public function set_root(bool $is_root): void
    {
        $this->is_root = $is_root;
        $this->set_updated_at(new DateTime('now'));
    }

    public function is_root(): string
    {
        return $this->is_root;
    }
}
