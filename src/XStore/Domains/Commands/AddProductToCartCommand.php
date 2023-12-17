<?php


namespace XStore\Domains\Commands;


class AddProductToCartCommand extends Command
{
    private int $user_id;
    private int $property_id;
    private int $number;

    public function __construct(int $user_id, int $property_id, int $number)
    {
        $this->user_id = $user_id;
        $this->property_id = $property_id;
        $this->number = $number;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setPropertyId(int $property_id): void
    {
        $this->property_id = $property_id;
    }

    public function getPropertyId(): int
    {
        return $this->property_id;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}
