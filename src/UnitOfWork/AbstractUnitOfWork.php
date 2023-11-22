<?php

namespace UnitOfWork;

use Adapters\Repositories\AbstractRepository;

abstract class AbstractUnitOfWork
{

    private AbstractRepository $repo;

    public function collect_new_events()
    {
        foreach ($this->repo->get_cached() as $cached) {
            while (!empty($cached->events)) {
                yield array_shift($cached->events);
            }
        }
    }

    abstract public function commit(): void;
}
