<?php

namespace Adapters\Repositories;

class Abstract_Repository
{
    private array $cached = [];

    public function get_cached(): array
    {
        return $this->cached;
    }
}
