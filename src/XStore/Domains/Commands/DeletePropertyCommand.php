<?php


namespace XStore\Domains\Commands;


class DeletePropertyCommand extends Command
{

    private int $propertyId;

    public function __construct(int $propertyId)
    {
        $this->propertyId = $propertyId;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }
}
