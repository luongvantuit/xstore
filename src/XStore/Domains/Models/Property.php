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
    private string $sizeId;

    #[ORM\Column(name: "path", type: 'string')]
    private string $path;

    public function __construct(
        Product $product,
        string $color,
        string $number,
        string $price,
        string $sizeId,
        string $path
    ) {
        parent::__construct();
        $this->product = $product;
        $this->color = $color;
        $this->number = $number;
        $this->price = $price;
        $this->sizeId = $sizeId;
        $this->path = $path;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setSizeId(int $sizeId): void
    {
        $this->sizeId = $sizeId;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getSizeId(): int
    {
        return $this->sizeId;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
