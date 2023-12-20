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
    private ?Address $address;

    #[ORM\Column(
        name: "type_shipping_fee",
        enumType: TypeShippingFee::class,
        options: ["default" => TypeShippingFee::OTHER_SHIPPING]
    )]
    private ?TypeShippingFee $typeShippingFee = TypeShippingFee::OTHER_SHIPPING;

    #[ORM\Column(name: "status", enumType: OrderStatus::class, options: ["default" => OrderStatus::INCARD])]
    private OrderStatus $status = OrderStatus::INCARD;

    public function __construct(
        User $user,
        ?Address $address,
        ?TypeShippingFee $typeShippingFee,
        OrderStatus $status
    ) {
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

    public function setTypeShippingFee(TypeShippingFee $typeShippingFee): void
    {
        $this->typeShippingFee = $typeShippingFee;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getTypeShippingFee(): TypeShippingFee
    {
        return $this->typeShippingFee;
    }

    public function setStatus(OrderStatus $status): void
    {
        $this->status = $status;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }
}
