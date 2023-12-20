<?php

namespace XStore\Adapters\Repositories;

use XStore\Domains\Models\BaseModel;

abstract class AbstractRepository
{
    private array $cached;

    public function __construct()
    {
        $this->cached = [];
    }

    public function add(BaseModel $model): void
    {
        $this->_add($model);
        array_push($this->cached, $model);
    }

    abstract protected function _add(BaseModel $model): void;

    public function get(string $clz, ?array $filters = []): ?BaseModel
    {
        $model = $this->_get($clz, $filters);
        if ($model != null) {
            array_push($this->cached, $model);
        }
        return $model;
    }

    abstract protected function _get(string $clz, ?array $filters = []): ?BaseModel;


    public function getAll(string $clz, ?array $filters = []): ?array
    {
        $models = $this->_getAll($clz, $filters);
        foreach ($models as $model) {
            array_push($this->cached, $model);
        }
        return $models;
    }

    abstract protected function _getAll(string $clz, ?array $filters = []): ?array;


    public function remove(string $clz, ?array $filters = []): int
    {
        return $this->_remove($clz, $filters);
    }

    abstract protected function _remove(string $clz, ?array $filters = []): int;

    public function getCached(): array
    {
        return $this->cached;
    }

    public function set_cached(array $cached = []): void
    {
        $this->cached = $cached;
    }
}
