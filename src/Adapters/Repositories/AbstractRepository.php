<?php

namespace Adapters\Repositories;

use Domains\Models\BaseModel;

abstract class AbstractRepository
{
    private array $cached = [];

    public function __construct()
    {
    }

    abstract public function find(): ?BaseModel;

    public function get_cached(): array
    {
        return $this->cached;
    }
}
