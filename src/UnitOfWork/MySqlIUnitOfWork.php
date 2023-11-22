<?php

namespace UnitOfWork;

use Adapters\Repositories\AbstractRepository;
use mysqli;
use ReflectionClass;

require_once __DIR__ . "/../Configs.php";

class MySqlIUnitOfWork extends AbstractUnitOfWork
{

    static private ?MySqlIUnitOfWork $uow = null;

    private mysqli $conn;

    private function __construct(mysqli $conn)
    {
        parent::__construct();
        $this->conn = $conn;
    }

    public function session(string $classOfRepository): AbstractRepository
    {
        if ($this->repos[$classOfRepository] != null) {
            $reflection = new ReflectionClass($classOfRepository);
            $this->repos[$classOfRepository] = $reflection->newInstanceArgs([$this->conn]);
        }
        return $this->repos[$classOfRepository];
    }

    public function commit(): void
    {
        if (!$this->conn->commit()) {
            $this->rollback();
            exit();
        }
        foreach ($this->repos as $repo) {
            while (!empty($repo->get_cached())) {
                array_push($this->cached, array_shift($repo->get_cached()));
            }
        }
    }

    public function rollback(): void
    {
        $this->conn->rollback();
    }

    public function close(): void
    {
        $this->conn->close();
    }


    static public function get_instance(): MySqlIUnitOfWork
    {
        if (MySqlIUnitOfWork::$uow == null) {
            $mysql_info = get_mysql_info();
            $conn = call_user_func_array('mysqli_connect', $mysql_info);
            if (!$conn && $conn->connect_errno) {
                exit();
            }
            $conn->autocommit(FALSE);
            MySqlIUnitOfWork::$uow = new MySqlIUnitOfWork($conn);
        }
        return MySqlIUnitOfWork::$uow;
    }
}