<?php


namespace XStore\Domains\Commands;

class UpdateCartProductCommand extends Command
{
    private int $userId;
    private int $orderPropertyId;
    private int $number;
    private int $property_id;

    public function __construct(int $userId, int $orderPropertyId, int $number, int $property_id)
    {
        $this->userId = $userId;
        $this->orderPropertyId = $orderPropertyId;
        $this->number = $number;
        $this->property_id = $property_id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getOrderPropertyId(): int
    {
        return $this->orderPropertyId;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getPropertyId(): int
    {
        return $this->property_id;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setOrderPropertyId(int $orderPropertyId): void
    {
        $this->orderPropertyId = $orderPropertyId;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function setPropertyId(int $property_id): void
    {
        $this->property_id = $property_id;
    }
}
