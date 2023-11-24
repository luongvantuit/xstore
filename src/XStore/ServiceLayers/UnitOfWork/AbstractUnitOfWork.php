<?php

namespace XStore\ServiceLayers\UnitOfWork;

use XStore\Adapters\Repositories\AbstractRepository;

abstract class AbstractUnitOfWork
{

    protected ?AbstractRepository $repo = null;

    public function __construct()
    {
    }

    public function collect_new_events()
    {
        $cached = $this->repo->get_cached();
        $events = [];
        foreach ($cached as $c) {
            $_events = $c->get_events();
            array_merge($events, $_events);
            $c->set_events([]);
        }
        return $events;
    }

    abstract public function commit(): void;

    abstract public function rollback(): void;

    abstract public function get_repo(): AbstractRepository;
}
