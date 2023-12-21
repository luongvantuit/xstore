<?php

namespace XStore\Services;

class ProductService extends BaseService
{
    public function getProducts()
    {
        $conn = $this->uow->getEntityManager()->createQueryBuilder();

        $admin = \XStore\Domains\Models\Product::class;

        $query = $conn->select("p")
            ->from($admin, 'p')
            ->getQuery();

        return ($query->getResult());
    }
}