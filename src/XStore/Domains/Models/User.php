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
    private bool $email_ok = false;

    #[ORM\Column(name: "email_confirmation_token", type: 'string', nullable: true)]
    private string|null $email_confirmation_token;

    public function __construct(string $username, string $email, string $password, bool $email_ok = false, UserStatus $status = UserStatus::ACTIVE)
    {
        parent::__construct();
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->email_ok = $email_ok;
        $this->status = $status;
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

    public function set_email(string $email): void
    {
        $this->email = $email;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_email(): string
    {
        return $this->email;
    }

    public function set_status(UserStatus $status): void
    {
        $this->status = $status;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_status(): UserStatus
    {
        return $this->status;
    }

    public function set_email_ok(bool $email_ok): void
    {
        $this->email_ok = $email_ok;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_email_ok(): bool
    {
        return $this->email_ok;
    }

    public function set_email_confirmation_token(string|null $email_confirmation_token): void
    {
        $this->email_confirmation_token = $email_confirmation_token;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_email_confirmation_token(): string|null
    {
        return $this->email_confirmation_token;
    }
}
