<?php


namespace XStore\Domains\Commands;


class RemoveAdminCommand extends Command
{

    private int $adminId;

    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
    }


    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }
}
