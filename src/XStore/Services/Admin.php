<?php

namespace XStore\Services;
require_once __DIR__ . "/../Bootstrap.php";

use function XStore\bootstrap;

class Admin extends BaseService
{
    public function test()
    {
        $conn = $this->uow->getEntityManager()->createQueryBuilder();

        $admin = \XStore\Domains\Models\Admin::class;
        $params = [
            "id" => 1
        ];
        $query = $conn->select("a")
            ->from($admin, 'a')
            ->where('a.id = :id')
            ->setParameter('id', $params['id'])
            ->getQuery();

        return ($query->getResult()[0]->getPassword());
    }
}