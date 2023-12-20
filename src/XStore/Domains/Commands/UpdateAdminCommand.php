<?php


namespace XStore\Domains\Commands;


class UpdateAdminCommand extends Command
{

    private int $adminId;

    private string|null $username;
    private string|null $email;

    public function __construct(int $adminId, string|null $username = null, string|null $email = null)
    {
        $this->adminId = $adminId;
        $this->username = $username;
        $this->email = $email;
    }


    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }


    public function getUsername(): string|null
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
