<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'orders')]

class Order extends BaseModel
{

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "orders")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Address::class, inversedBy: "orders")]
    #[ORM\JoinColumn(name: "address_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private Address $address;


    #[ORM\Column(name: "type_shipping_fee", type: 'integer')]
    private int $typeShippingFee;

    #[ORM\Column(name: "status", type: 'string')]
    private string $status;

    public function __construct(User $user, Address $address, int $typeShippingFee, string $status)
    {
        parent::__construct();
        $this->user = $user;
        $this->address = $address;
        $this->typeShippingFee = $typeShippingFee;
        $this->status = $status;
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

    public function setAddress(Address $address): void
    {
        $this->address = $address;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setTypeShippingFee(int $typeShippingFee): void
    {
        $this->typeShippingFee = $typeShippingFee;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getTypeShippingFee(): int
    {
        return $this->typeShippingFee;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
