<?php


namespace XStore\Domains\Commands;

class DeleteAddressCommand extends Command
{
    private int $user_id;
    private int $address_id;

    public function __construct(int $user_id, int $address_id)
    {
        $this->user_id = $user_id;
        $this->address_id = $address_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getAddressId(): int
    {
        return $this->address_id;
    }
}
