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
    private DateTime $createdAt;

    #[ORM\Column(name: "updated_at", type: 'datetime', nullable: true)]
    private DateTime|null $updatedAt;

    private array $events;

    public function __construct()
    {
        $this->id = null;
        $this->createdAt = new DateTime();
        $this->updatedAt = null;
        $this->events = [];
    }

    public function getEvents(): array
    {
        if (empty($this->events)) {
            $this->events = [];
        }
        return $this->events;
    }

    public function setEvents(array $events = [])
    {
        $this->events = $events;
    }

    public function getId(): int|null
    {
        return $this->id;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime|null
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt = new DateTime()): void
    {
        $this->updatedAt = $updatedAt;
    }
}
