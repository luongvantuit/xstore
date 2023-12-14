<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'properties')]

class Property extends BaseModel
{

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: "properties")]
    #[ORM\JoinColumn(name: "product_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private Product $product;

    #[ORM\Column(name: "color", type: 'string')]
    private string $color;

    #[ORM\Column(name: "number", type: 'integer')]
    private string $number;

    #[ORM\Column(name: "price", type: 'float')]
    private string $price;

    #[ORM\Column(name: "size_id", type: 'integer')]
    private string $size_id;

    #[ORM\Column(name: "path", type: 'string')]
    private string $path;

    public function __construct(
        Product $product,
        string $color,
        string $number,
        string $price,
        string $size_id,
        string $path
    ) {
        parent::__construct();
        $this->product = $product;
        $this->color = $color;
        $this->number = $number;
        $this->price = $price;
        $this->size_id = $size_id;
        $this->path = $path;
    }

    public function set_product(Product $product): void
    {
        $this->product = $product;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_product(): Product
    {
        return $this->product;
    }

    public function set_color(string $color): void
    {
        $this->color = $color;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_color(): string
    {
        return $this->color;
    }

    public function set_number(string $number): void
    {
        $this->number = $number;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_number(): string
    {
        return $this->number;
    }

    public function set_price(string $price): void
    {
        $this->price = $price;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_price(): string
    {
        return $this->price;
    }

    public function set_size_id(int $size_id): void
    {
        $this->size_id = $size_id;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_size_id(): int
    {
        return $this->size_id;
    }

    public function set_path(string $path): void
    {
        $this->path = $path;
        $this->set_updated_at(new DateTime('now'));
    }

    public function get_path(): string
    {
        return $this->path;
    }
}
