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
    private bool $isRoot = false;



    public function setEmail(string $email): void
    {
        $this->email = $email;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setRoot(bool $isRoot): void
    {
        $this->isRoot = $isRoot;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function isRoot(): string
    {
        return $this->isRoot;
    }


}
