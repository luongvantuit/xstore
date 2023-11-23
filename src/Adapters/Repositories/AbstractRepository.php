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

    public  function find(?array $filters = null): ?BaseModel
    {
        $model = $this->_find($filters);
        if ($model != null) {
            array_push($this->cached, $model);
        }
        return $model;
    }

    abstract protected function _find(?array $filters = null): ?BaseModel;

    public  function findAll(?array $filters = null): array
    {
        $models = $this->_findAll($filters);
        array_merge($this->cached, $models);
        return $models;
    }

    abstract protected function _findAll(?array $filters = null): array;

    public function add(BaseModel $model): void
    {
        $_m = $this->add($model);
        if ($_m != null) {
            array_push($this->cached, $model);
        }
    }

    abstract protected function _add(BaseModel $model): ?BaseModel;

    public function update(?array $filters = null, ?array $v = null): array
    {
        $c = $this->_update($filters, $v);
        if ($c == 0) {
            return [];
        }
        $models = $this->findAll($filters);
        return $models;
    }

    abstract protected function _update(?array $filters = null, ?array $v = null): int;

    public function remove(?array $filters = null): int
    {
        $models = $this->findAll($filters);
        $this->_remove($filters);
        return count($models);
    }

    abstract protected function _remove(?array $filters = null): int;

    abstract protected function count(?array $filters = null): int;

    public function get_cached(): array
    {
        return $this->cached;
    }
}
