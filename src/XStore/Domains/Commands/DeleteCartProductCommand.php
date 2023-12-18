<?php


namespace XStore\Domains\Commands;

class DeleteCartProductCommand extends Command
{
    private int $userId;
    private int $propertyId;

    public function __construct(int $userId, int $propertyId)
    {
        $this->userId = $userId;
        $this->propertyId = $propertyId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }
}
