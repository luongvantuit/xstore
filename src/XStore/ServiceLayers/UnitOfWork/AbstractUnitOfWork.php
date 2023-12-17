<?php

namespace XStore\ServiceLayers\UnitOfWork;

use XStore\Adapters\Repositories\AbstractRepository;

abstract class AbstractUnitOfWork
{

    protected ?AbstractRepository $repo;

    public function __construct()
    {
        $this->repo = null;
    }

    abstract function beginTransaction(): void;

    public function collectNewEvents()
    {
        $cached = $this->repo->getCached();
        $events = [];
        foreach ($cached as $c) {
            $_events = $c->getEvents();
            $events = array_merge($events, $_events);
            $c->setEvents([]);
        }
        return $events;
    }

    abstract public function commit(): void;

    abstract public function rollback(): void;

    abstract public function getRepository(): AbstractRepository;
}
