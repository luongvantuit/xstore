<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User extends BaseModel
{

    #[ORM\Column(name: "username", type: 'string', unique: true)]
    private string $username;

    #[ORM\Column(name: "email", type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(name: "password", type: 'string')]
    private string $password;

    #[ORM\Column(name: "status", enumType: UserStatus::class, options: ["default" => UserStatus::ACTIVE])]
    private UserStatus $status = UserStatus::ACTIVE;

    #[ORM\Column(name: "email_ok", type: 'boolean', options: ["default" => false])]
    private bool $emailOk = false;

    #[ORM\Column(name: "email_confirmation_token", type: 'string', nullable: true)]
    private string|null $emailConfirmationToken;

    public function __construct(string $username, string $email, string $password, bool $emailOk = false, UserStatus $status = UserStatus::ACTIVE)
    {
        parent::__construct();
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->emailOk = $emailOk;
        $this->status = $status;
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

    public function setEmail(string $email): void
    {
        $this->email = $email;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setStatus(UserStatus $status): void
    {
        $this->status = $status;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getStatus(): UserStatus
    {
        return $this->status;
    }

    public function setEmailOk(bool $emailOk): void
    {
        $this->emailOk = $emailOk;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getEmailOk(): bool
    {
        return $this->emailOk;
    }

    public function setEmailConfirmationToken(string|null $emailConfirmationToken): void
    {
        $this->emailConfirmationToken = $emailConfirmationToken;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getEmailConfirmationToken(): string|null
    {
        return $this->emailConfirmationToken;
    }
}
