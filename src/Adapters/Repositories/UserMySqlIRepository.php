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

    protected function _find(?array $filters = null): ?BaseModel
    {
        return null;
    }

    protected function _findAll(?array $filters = null): array
    {
        return [];
    }

    protected function _add(BaseModel $model): ?BaseModel
    {
        if (!$model instanceof User) {
            return null;
        }
        return null;
    }

    protected function _update(?array $filters = null, ?array $v = null): int
    {
        return 0;
    }

    protected function _remove(?array $filters = null): int
    {
        return 0;
    }

    protected function count(?array $filters = null): int
    {
        return 0;
    }
}
