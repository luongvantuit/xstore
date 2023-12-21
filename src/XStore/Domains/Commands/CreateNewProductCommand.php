<?php


namespace XStore\Domains\Commands;


class CreateNewProductCommand extends Command
{
    private string $name;

    private string|null $description;

    private string $path;

    public function __construct(string $name, string|null $description, string $path)
    {
        $this->name = $name;
        $this->description = $description;
        $this->path = $path;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string|null $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
