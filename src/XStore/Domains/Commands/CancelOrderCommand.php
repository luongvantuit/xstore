<?php


namespace XStore\Domains\Commands;

class CancelOrderCommand extends Command
{
    private int $userId;
    private int $orderId;

    public function __construct(int $userId, int $orderId)
    {
        $this->userId = $userId;
        $this->orderId = $orderId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }
}
