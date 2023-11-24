<?php

namespace XStore\Domains\Models;

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

    public function set_events(array $v = [])
    {
        $this->events = $v;
    }
}
