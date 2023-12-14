<?php

namespace XStore\Adapters\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use XStore\Adapters\Repositories\AbstractRepository;
use XStore\Domains\Models\BaseModel;

class DoctrineRepository extends AbstractRepository
{

    private EntityManagerInterface $entity_manager;

    public function __construct(EntityManagerInterface $entity_manager)
    {
        parent::__construct();
        $this->entity_manager = $entity_manager;
    }

    protected function _add(BaseModel $model): void
    {
        $this->entity_manager->persist($model);
        $this->entity_manager->flush();
    }

    protected function _get(string $clz, ?array $filters = []): ?BaseModel
    {
        return $this->entity_manager->getRepository($clz)->findOneBy($filters);
    }

    protected function _remove(string $clz, ?array $filters = []): int
    {
        $entities = $this->entity_manager->getRepository($clz)->findBy($filters);
        foreach ($entities as $entity) {
            $this->entity_manager->remove($entity);
        }
        $this->entity_manager->flush();
        return count($entities);
    }
}
