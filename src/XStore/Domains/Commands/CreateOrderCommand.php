<?php

namespace XStore\Domains\Commands;

class CreateOrderCommand extends Command
{
    private int $userId;
    private int $addressId;
    private array $products;

    public function __construct(int $userId, int $addressId, array $products)
    {
        $this->userId = $userId;
        $this->addressId = $addressId;
        $this->products = $products;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setAddressId(int $addressId): void
    {
        $this->addressId = $addressId;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }
}
