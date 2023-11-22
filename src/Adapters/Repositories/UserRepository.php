<?php

namespace Adapters\Repositories;

use Domains\Models\BaseModel;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
    }

    public function find(): ?BaseModel
    {
        return null;
    }
}
