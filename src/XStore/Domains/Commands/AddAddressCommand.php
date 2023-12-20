<?php


namespace XStore\Domains\Commands;

class AddAddressCommand extends Command
{
    private int $user_id;
    private string $first_name;
    private string $last_name;
    private string $phone_number;
    private string $address;
    private string $email;
    private bool $default_address;

    public function __construct(
        int $user_id,
        string $first_name,
        string $last_name,
        string $phone_number,
        string $address,
        string $email,
        bool $default_address
    ) {
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->email = $email;
        $this->default_address = $default_address;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDefaultAddress(): bool
    {
        return $this->default_address;
    }
}
