<?php

namespace Domains\Models;

class BaseModel
{
    private array $events;

    public function __construct()
    {
        $this->events = [];
    }

    public function get_events(): array
    {
        return $this->events;
    }
}