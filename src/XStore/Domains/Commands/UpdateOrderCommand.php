<?php


namespace XStore\Domains\Commands;

class UpdateOrderCommand extends Command
{
    private int $orderId;
    private int $userId;
    private int $addressId;

    public function __construct(int $userId, int $orderId, int $addressId)
    {
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->addressId = $addressId;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }


    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setAddressId(int $addressId): void
    {
        $this->addressId = $addressId;
    }
}
