<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'order_products')]

class OrderProduct extends BaseModel
{

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: "order_products")]
    #[ORM\JoinColumn(name: "order_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private Order $order;

    #[ORM\ManyToOne(targetEntity: Property::class, inversedBy: "order_products")]
    #[ORM\JoinColumn(name: "property_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private Property $property;


    #[ORM\Column(name: "number", type: 'float')]
    private float $number;

    public function __construct(Order $order, Property $property, float $number)
    {
        parent::__construct();
        $this->order = $order;
        $this->property = $property;
        $this->number = $number;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setProperty(Property $property): void
    {
        $this->property = $property;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getProperty(): Property
    {
        return $this->property;
    }

    public function setNumber(float $number): void
    {
        $this->number = $number;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getNumber(): float
    {
        return $this->number;
    }
}
