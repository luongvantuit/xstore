<?php


namespace XStore\Domains\Commands;

class UpdateCartProductCommand extends Command
{
    private int $userId;
    private int $propertyId;
    private int $number;


    public function __construct(int $userId, int $propertyId, int $number)
    {
        $this->userId = $userId;
        $this->propertyId = $propertyId;
        $this->number = $number;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }
}
