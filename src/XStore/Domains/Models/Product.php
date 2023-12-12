<?php

namespace XStore\Domains\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class Product extends BaseModel
{

    #[ORM\Column(name: "name", type: 'string')]
    private string $name;

    #[ORM\Column(name: "description", type: 'string')]
    private string $description;

    #[ORM\Column(name: "path", type: 'string')]
    private string $path;

    public function __construct(string $name, string $description, string $path)
    {
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
        $this->path = $path;
    }

    public function set_name(string $name): void
    {
        $this->name = $name;
    }

    public function get_name(): string
    {
        return $this->name;
    }

    public function set_description(string $description): void
    {
        $this->description = $description;
    }

    public function get_description(): string
    {
        return $this->description;
    }

    public function set_path(string $path): void
    {
        $this->path = $path;
    }

    public function get_path(): string
    {
        return $this->path;
    }
}
