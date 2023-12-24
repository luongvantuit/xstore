<?php

namespace XStore\Domains\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class Product extends BaseModel
{

    #[ORM\Column(name: "name", type: 'string')]
    private string $name;

    #[ORM\Column(name: "description", type: 'text', nullable: true)]
    private string|null $description;

    #[ORM\Column(name: "path", type: 'string')]
    private string $path;

    public function __construct(string $name, string|null $description, string $path)
    {
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
        $this->path = $path;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string|null $description): void
    {
        $this->description = $description;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
        $this->setUpdatedAt(new DateTime('now'));
    }

    public function getPath(): string
    {
        return $this->path;
    }
}