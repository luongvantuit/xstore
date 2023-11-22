<?php

namespace UnitOfWork;

use mysqli;

require_once __DIR__ . "/../Configs.php";

class MySqlIUnitOfWork extends AbstractUnitOfWork
{

    static private ?MySqlIUnitOfWork $uow = null;

    private mysqli $conn;

    private function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function commit(): void
    {
        if (!$this->conn->commit()) {
            exit();
        }
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
