<?php

namespace Adapters\Repositories;

use Domains\Models\BaseModel;

abstract class AbstractRepository
{
    private array $cached;

    public function __construct()
    {
        $this->cached = [];
    }

    /**
     * @return T
     */
    abstract protected function find(): ?BaseModel;

    abstract protected function findAll(): array;

    public function add(BaseModel $model): void
    {
        $_m = $this->add($model);
        if ($_m != null) {
            array_push($this->cached, $model);
        }
    }
    abstract protected function _add(BaseModel $model): ?object;

    abstract protected function remove(array $filters): int;

    abstract protected function count(array $filters): int;

    public function get_cached(): array
    {
        return $this->cached;
    }
}