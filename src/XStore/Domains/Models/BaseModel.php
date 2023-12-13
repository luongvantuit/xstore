<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
class BaseModel
{

    #[ORM\Id]
    #[ORM\Column(name: "id", type: 'integer', updatable: false)]
    #[ORM\GeneratedValue]
    private int|null $id;

    private array $events;

    public function __construct()
    {
        $this->id = null;
        $this->events = [];
    }

    public function get_events(): array
    {
        if (empty($this->events)) {
            $this->events = [];
        }
        return $this->events;
    }

    public function set_events(array $events = [])
    {
        $this->events = $events;
    }

    public function get_id(): int|null
    {
        return $this->id;
    }
}
