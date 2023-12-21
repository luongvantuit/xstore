<?php


namespace XStore\Domains\Commands;


class CreateNewPropertyCommand extends Command
{
    private string $color;

    private int $sizeId;

    private int $number;

    private float $price;

    private int $productId;

    private string|null $path;

    public function __construct(int $productId, string $color, int $number, float $price, int $sizeId, string|null $path)
    {
        $this->productId = $productId;
        $this->color = $color;
        $this->price = $price;
        $this->number = $number;
        $this->path = $path;
        $this->sizeId = $sizeId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setSizeId(int $sizeId): void
    {
        $this->sizeId = $sizeId;
    }

    public function getSizeId(): int
    {
        return $this->sizeId;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getNumber(): string|null
    {
        return $this->number;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setPath(string|null $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string|null
    {
        return $this->path;
    }
}
