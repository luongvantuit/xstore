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
    private string $firstName;

    #[ORM\Column(name: "last_name", type: 'string')]
    private string $lastName;

    #[ORM\Column(name: "address", type: 'string')]
    private string $address;

    #[ORM\Column(name: "email", type: 'string')]
    private string $email;

    #[ORM\Column(name: "phone_number", type: 'string')]
    private string $phoneNumber;

    #[ORM\Column(name: "default_address", type: 'boolean')]
    private bool $defaultAddress;

    public function __construct(
        User $user,
        string $firstName,
        string $lastName,
        string $address,
        string $email,
        string $phoneNumber,
        bool $defaultAddress
    ) {
        parent::__construct();
        $this->user = $user;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->defaultAddress = $defaultAddress;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getAddress(): string
    {
        return $this->address;
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

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setDefaultAddress(bool $defaultAddress): void
    {
        $this->defaultAddress = $defaultAddress;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getDefaultAddress(): bool
    {
        return $this->defaultAddress;
    }
}
