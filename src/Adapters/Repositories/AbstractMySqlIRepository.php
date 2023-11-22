<?php

namespace Adapters\Repositories;

use mysqli;

abstract class AbstractMySqlIRepository extends AbstractRepository
{

    protected mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }
}
