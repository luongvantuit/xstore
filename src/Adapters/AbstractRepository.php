<?php

namespace Adapters;

class AbstractRepository
{
    private array $cached = [];

    public function get_cached(): array
    {
        return $this->cached;
    }
}
