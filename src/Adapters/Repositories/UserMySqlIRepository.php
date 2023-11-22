<?php

namespace Adapters\Repositories;

use Domains\Models\BaseModel;
use Domains\Models\User;
use mysqli;

class UserMySqlIRepository extends AbstractMySqlIRepository
{
    public function __construct(mysqli $conn)
    {
        parent::__construct($conn);
    }

    protected function find(): ?BaseModel
    {
        return null;
    }

    protected function findAll(): array
    {
        return [];
    }

    protected function _add(BaseModel $model): ?object
    {
        if (!$model instanceof User) {
            return null;
        }
        return null;
    }

    protected function remove(array $filters): int
    {
        return 0;
    }

    protected function count(array $filters): int
    {
        return 0;
    }
}
