<?php


namespace XStore\Domains\Commands;

class DeleteCartProductCommand extends Command
{
    private int $userId;
    private int $orderPropertyId;

    public function __construct(int $userId, int $orderPropertyId)
    {
        $this->userId = $userId;
        $this->orderPropertyId = $orderPropertyId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setOrderPropertyId(int $orderPropertyId): void
    {
        $this->orderPropertyId = $orderPropertyId;
    }

    public function getOrderPropertyId(): int
    {
        return $this->orderPropertyId;
    }
}
