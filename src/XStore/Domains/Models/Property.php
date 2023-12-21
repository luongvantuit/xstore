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
    private int $number;

    #[ORM\Column(name: "price", type: 'float')]
    private float $price;

    #[ORM\Column(name: "size_id", type: 'integer')]
    private int $sizeId;

    #[ORM\Column(name: "path", type: 'string', nullable: true)]
    private string|null $path;

    public function __construct(
        Product $product,
        string $color,
        int $number,
        float $price,
        int $sizeId,
        string|null $path
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

    public function setNumber(int $number): void
    {
        $this->number = $number;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getPrice(): float
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

    public function setPath(string|null $path): void
    {
        $this->path = $path;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getPath(): string|null
    {
        return $this->path;
    }
}
