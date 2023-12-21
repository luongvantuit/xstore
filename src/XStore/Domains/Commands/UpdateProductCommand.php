<?php


namespace XStore\Domains\Commands;


class UpdateProductCommand extends Command
{
    private string|null $name;

    private string|null $description;

    private string|null $path;

    public function __construct(string|null $name, string|null $description, string|null $path)
    {
        $this->name = $name;
        $this->description = $description;
        $this->path = $path;
    }
    public function setName(string|null $name): void
    {
        $this->name = $name;
    }

    public function getName(): string|null
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

    public function setPath(string|null $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string|null
    {
        return $this->path;
    }
}
