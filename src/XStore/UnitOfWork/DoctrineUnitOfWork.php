<?php

namespace XStore\UnitOfWork;

use Doctrine\ORM\EntityManagerInterface;
use XStore\Adapters\Repositories\AbstractRepository;
use XStore\Adapters\Repositories\DoctrineRepository;

class DoctrineUnitOfWork extends AbstractUnitOfWork
{

    private EntityManagerInterface $entity_manager;

    public function __construct(EntityManagerInterface $entity_manager)
    {
        parent::__construct();
        $this->entity_manager = $entity_manager;
        $this->repo = new DoctrineRepository($this->entity_manager);
    }

    public function commit(): void
    {
        $this->entity_manager->commit();
    }

    public function rollback(): void
    {
        $this->entity_manager->rollback();
    }

    public function get_repo(): AbstractRepository
    {
        if ($this->repo == null) {
            $this->repo = new DoctrineRepository($this->entity_manager);
        }
        $this->entity_manager->beginTransaction();
        return $this->repo;
    }
}