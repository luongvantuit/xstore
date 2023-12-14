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

    #[ORM\Column(name: "created_at", type: 'datetime', updatable: false, options: ["default" => "CURRENT_TIMESTAMP"])]
    private DateTime $created_at;

    #[ORM\Column(name: "updated_at", type: 'datetime', nullable: true)]
    private DateTime|null $updated_at;

    private array $events;

    public function __construct()
    {
        $this->id = null;
        $this->created_at = new DateTime();
        $this->updated_at = null;
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
    public function get_created_at(): DateTime
    {
        return $this->created_at;
    }

    public function get_updated_at(): DateTime|null
    {
        return $this->updated_at;
    }

    public function set_updated_at(DateTime $update_at = new DateTime()): void
    {
        $this->updated_at = $update_at;
    }
}
