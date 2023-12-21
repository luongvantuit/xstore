<?php

namespace XStore\Services;

class DetailService extends BaseService
{
    public function getProduct($id)
    {
        $conn = $this->uow->getEntityManager()->createQueryBuilder();

        $product = \XStore\Domains\Models\Product::class;

        $query = $conn->select("p")
            ->from($product, 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return ($query->getResult()[0]);
    }
    public function  getProperties($params = [])
    {

        $sql = "SELECT * FROM products, properties WHERE product_id = :id and products.id = properties.product_id ";
        if($params && !empty($params['color'])){
            $sql.= 'and color = :color';
        }

        $conn = $this->uow->getEntityManager()->getConnection();

        /** @var array $results */
        $result = $conn->executeQuery($sql, $params)->fetchAllAssociative();

        return $result;
    }


}