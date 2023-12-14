<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'addresses')]
class Address extends BaseModel
{

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "addresses")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private User $user;

    #[ORM\Column(name: "first_name", type: 'string')]
    private string $first_name;

    #[ORM\Column(name: "last_name", type: 'string')]
    private string $last_name;

    #[ORM\Column(name: "address", type: 'string')]
    private string $address;

    #[ORM\Column(name: "email", type: 'string')]
    private string $email;

    #[ORM\Column(name: "phone_number", type: 'string')]
    private string $phone_number;

    #[ORM\Column(name: "default_address", type: 'boolean')]
    private bool $default_address;

    public function __construct(
        User $user,
        string $first_name,
        string $last_name,
        string $address,
        string $email,
        string $phone_number,
        bool $default_address
    ) {
        parent::__construct();
        $this->user = $user;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->default_address = $default_address;
    }

    public function set_user(User $user): void
    {
        $this->user = $user;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_user(): User
    {
        return $this->user;
    }

    public function set_first_name(string $first_name): void
    {
        $this->first_name = $first_name;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_first_name(): string
    {
        return $this->first_name;
    }

    public function set_last_name(string $last_name): void
    {
        $this->last_name = $last_name;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_last_name(): string
    {
        return $this->last_name;
    }

    public function set_address(string $address): void
    {
        $this->address = $address;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_address(): string
    {
        return $this->address;
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

    public function set_phone_number(string $phone_number): void
    {
        $this->phone_number = $phone_number;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_phone_number(): string
    {
        return $this->phone_number;
    }

    public function set_default_address(bool $default_address): void
    {
        $this->default_address = $default_address;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_default_address(): bool
    {
        return $this->default_address;
    }
}
