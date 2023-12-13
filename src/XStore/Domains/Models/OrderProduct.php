<?php

namespace XStore\Domains\Models;

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

    public function set_order(Order $order): void
    {
        $this->order = $order;
    }

    public function get_order(): Order
    {
        return $this->order;
    }

    public function set_property(Property $property): void
    {
        $this->property = $property;
    }

    public function get_property(): Property
    {
        return $this->property;
    }



    public function set_number(float $number): void
    {
        $this->number = $number;
    }

    public function get_number(): float
    {
        return $this->number;
    }
}
