<?php

namespace UnitOfWork;

use Adapters\Repositories\AbstractRepository;

abstract class AbstractUnitOfWork
{

    protected array $cached;

    protected array $repos;

    public function __construct()
    {
        $this->cached = [];
        $this->repos = [];
    }

    public function collect_new_events()
    {
        foreach ($this->cached as $cached) {
            while (!empty($cached->get_events())) {
                yield array_shift($cached->get_events());
            }
        }
    }

    abstract public function session(string $classOfRepository): AbstractRepository;

    abstract public function commit(): void;

    abstract public function rollback(): void;

    abstract public function close(): void;
}