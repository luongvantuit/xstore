<?php

namespace XStore\Domains\Events;


class CreatedUserEvent extends Event
{

    private int|null $id;

    public function __construct(int|null $id)
    {
        $this->id = $id;
    }

    public function getId(): int| null
    {
        return $this->id;
    }
}
