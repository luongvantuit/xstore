<?php


namespace XStore\Domains\Commands;

class UpdateAddressCommand extends Command
{
    private int $userId;
    private int $addressId;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $phoneNumber;
    private ?string $address;
    private ?string $email;
    private ?bool $defaultAddress;

    public function __construct(
        int $userId,
        int $addressId,
        ?string $firstName,
        ?string $lastName,
        ?string $phoneNumber,
        ?string $address,
        ?string $email,
        ?bool $defaultAddress
    ) {
        $this->userId = $userId;
        $this->addressId = $addressId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->email = $email;
        $this->defaultAddress = $defaultAddress;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getDefaultAddress(): ?bool
    {
        return $this->defaultAddress;
    }

    public function getUpdateData(): array
    {
        $data = [];
        if ($this->firstName) {
            $data['first_name'] = $this->firstName;
        }
        if ($this->lastName) {
            $data['last_name'] = $this->lastName;
        }
        if ($this->phoneNumber) {
            $data['phone_number'] = $this->phoneNumber;
        }
        if ($this->address) {
            $data['address'] = $this->address;
        }
        if ($this->email) {
            $data['email'] = $this->email;
        }
        if ($this->defaultAddress) {
            $data['default_address'] = $this->defaultAddress;
        }
        return $data;
    }
}
