<?php

namespace XStore;

use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\X\Jw\AbstractJwt;
use XStore\Domains\Models\OrderStatus;

class Views
{
    private function __construct()
    {
    }

    public static function getAdminById(DoctrineUnitOfWork $uow, int $id): array | null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM admins WHERE id = :id;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "id" => $id
        ];
        /** @var array $results */
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result;
    }


    public static function getUserById(DoctrineUnitOfWork $uow, int $id): array | null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM users WHERE id = :id;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "id" => $id
        ];
        /** @var array $results */
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function getUserByEmail(DoctrineUnitOfWork $uow, string $email): array|null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM users WHERE email = :email;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "email" => strtolower($email)
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function getUserByIdentify(DoctrineUnitOfWork $uow, string $identify): array | null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM users WHERE email = :email OR username = :username;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "email" => strtolower($identify),
            "username" => strtolower($identify)
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function getJwtTokenOfUser(DoctrineUnitOfWork $uow, int $userId, AbstractJwt $jwt): string|null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM users WHERE id = :id;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "id" => $userId
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $jwt->encode($result);
    }

    public static function getAdminByIdentify(DoctrineUnitOfWork $uow, string $identify): array | null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM admins WHERE username = :username;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "username" => strtolower($identify)
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function getJwtTokenOfAdmin(DoctrineUnitOfWork $uow, int $adminId, AbstractJwt $jwt): string|null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM admins WHERE id = :id;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "id" => $adminId
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $jwt->encode($result);
    }


    public static function getCartProductByUserId(DoctrineUnitOfWork $uow, int $userId): array|null
    {
        $sql = "SELECT id FROM orders WHERE user_id = :user_id AND status = :status_order;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "user_id" => $userId,
            "status_order" => OrderStatus::INCARD->value
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        $sql = "SELECT order_products.id, order_products.property_id, order_products.number
        FROM order_products
        WHERE order_id = :order_id;";
        $params = [
            "order_id" => $result['id']
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAllAssociative();

        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function getOrdersByUserId(DoctrineUnitOfWork $uow, int $userId): array|null
    {
        $sql = "SELECT id , status FROM orders WHERE user_id = :user_id and status != :status_order;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "user_id" => $userId,
            "status_order" => OrderStatus::INCARD->value
        ];
        $orders = $conn->executeQuery($sql, $params)->fetchAllAssociative();
        if (!$orders) {
            return null;
        }
        $ids = array_map(fn ($order) => $order['id'], $orders);
        $sql = "SELECT order_products.id, order_products.property_id, order_products.number, order_products.order_id
        FROM order_products
        WHERE order_id in (" . join(",", $ids) . ");";
        $product_orders = $conn->executeQuery($sql, $params)->fetchAllAssociative();
        if (!$product_orders) {
            return null;
        }
        $result = [];
        foreach ($orders as $order) {
            $result[$order['id']]['products'] = [];
            $result[$order['id']]['status'] = $order['status'];
        }
        foreach ($product_orders as $product_order) {
            $result[$product_order['order_id']]['products'][] = $product_order;
        }
        return $result;
    }

    public static function getUserIdByJwt(DoctrineUnitOfWork $uow, AbstractJwt $jwt, string $token): int|null
    {
        $payload = $jwt->decode($token);
        $sql = "SELECT id FROM users WHERE id = :id;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "id" => $payload['id']
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result['id'];
    }

    public static function getProducts(DoctrineUnitOfWork $uow): array
    {
        $sql = "SELECT id, name, path, description FROM products;";
        $conn = $uow->getEntityManager()->getConnection();
        $products = $conn->executeQuery($sql)->fetchAllAssociative();
        if (!$products) {
            return [];
        }

        $sql = "SELECT id, product_id, color, number, size_id, created_at, updated_at, path FROM properties;";
        $properties = $conn->executeQuery($sql)->fetchAllAssociative();
        if (!$properties) {
            return [];
        }

        foreach ($products as &$product) {
            $product['properties'] = [];
        }

        foreach ($properties as $property) {
            $product['properties'][] = $property;
        }

        return $products;
    }

    public static function getAddressByUserId(DoctrineUnitOfWork $uow, int $userId): array|null
    {
        $sql = "SELECT id, first_name, last_name, phone_number, address, email, default_address FROM addresses WHERE user_id = :user_id;";
        $conn = $uow->getEntityManager()->getConnection();
        $params = [
            "user_id" => $userId
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAllAssociative();
        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function getAdmins(DoctrineUnitOfWork $uow, string|null $search = null, int $limit = 10, int $offset = 0): array|null
    {
        $where = " WHERE 1 ";
        if ($search != null && $search != "") {
            $where = $where . " AND (username LIKE `%" . $search . "%` OR email LIKE `%" . $search . "%` OR id LIKE `%" . $search . "%`) ";
        }
        $conn = $uow->getEntityManager()->getConnection();
        $params = [];
        $sql = "SELECT id, username, email, created_at, updated_at FROM admins " . $where . " LIMIT " . $offset . "," . $limit;
        $results = $conn->executeQuery($sql, $params)->fetchAllAssociative();
        if (!$results) {
            return null;
        }
        return $results;
    }

    public static function getSizeOfAdmins(DoctrineUnitOfWork $uow, string|null $search = null): int|null
    {
        $where = " WHERE 1 ";
        if ($search != null && $search != "") {
            $where = $where . " AND (username LIKE `%" . $search . "%` OR email LIKE `%" . $search . "%` OR id LIKE `%" . $search . "%`) ";
        }
        $conn = $uow->getEntityManager()->getConnection();
        $params = [];
        $sql = "SELECT COUNT(*) as count FROM admins " . $where;
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result["count"];
    }

    public static function getUsers(DoctrineUnitOfWork $uow, string|null $search = null, int $limit = 10, int $offset = 0): array|null
    {
        $where = " WHERE 1 ";
        if ($search != null && $search != "") {
            $where = $where . " AND (username LIKE `%" . $search . "%` OR email LIKE `%" . $search . "%` OR id LIKE `%" . $search . "%`) ";
        }
        $conn = $uow->getEntityManager()->getConnection();
        $params = [];
        $sql = "SELECT id, username, email, status, email_ok, created_at, updated_at FROM users " . $where . " LIMIT " . $offset . "," . $limit;
        $results = $conn->executeQuery($sql, $params)->fetchAllAssociative();
        if (!$results) {
            return null;
        }
        return $results;
    }

    public static function getSizeOfUsers(DoctrineUnitOfWork $uow, string|null $search = null): int|null
    {
        $where = " WHERE 1 ";
        if ($search != null && $search != "") {
            $where = $where . " AND (username LIKE `%" . $search . "%` OR email LIKE `%" . $search . "%` OR id LIKE `%" . $search . "%`) ";
        }
        $conn = $uow->getEntityManager()->getConnection();
        $params = [];
        $sql = "SELECT COUNT(*) as count FROM users " . $where;
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result["count"];
    }

    public static function getSizeOfProducts(DoctrineUnitOfWork $uow, string|null $search = null): int|null
    {
        $where = " WHERE 1 ";
        if ($search != null && $search != "") {
            $where = $where . " AND (name LIKE `%" . $search . "%` OR description LIKE `%" . $search . "%`) ";
        }
        $conn = $uow->getEntityManager()->getConnection();
        $params = [];
        $sql = "SELECT COUNT(*) as count FROM products ";
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result["count"];
    }


    public static function getProductsAgent(DoctrineUnitOfWork $uow, string|null $search = null, int $limit = 10, int $offset = 0): array|null
    {
        $where = " WHERE 1 ";
        if ($search != null && $search != "") {
            $where = $where . " AND (name LIKE `%" . $search . "%` OR description LIKE `%" . $search . "%`) ";
        }
        $conn = $uow->getEntityManager()->getConnection();
        $params = [];
        $sql = "SELECT id, name, description, path, created_at, updated_at FROM products " . $where . " LIMIT " . $offset . "," . $limit;
        $results = $conn->executeQuery($sql, $params)->fetchAllAssociative();
        if (!$results) {
            return null;
        }
        return $results;
    }

    public static function getSizeOfOrders(DoctrineUnitOfWork $uow, string|null $search = null): int|null
    {
        $conn = $uow->getEntityManager()->getConnection();
        $params = [];
        $sql = "SELECT COUNT(*) as count FROM orders "; // . $where;
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result["count"];
    }
    public static function getOrders(DoctrineUnitOfWork $uow, string|null $search = null, int $limit = 10, int $offset = 0): array|null
    {
        $conn = $uow->getEntityManager()->getConnection();
        $params = [];
        $sql = "SELECT id,address_id,user_id, type_shipping_fee, status,created_at,updated_at FROM orders " . " LIMIT " . $offset . "," . $limit; // . $where;
        $results = $conn->executeQuery($sql, $params)->fetchAllAssociative();
        if (!$results) {
            return null;
        }
        for ($index = 0; $index < sizeof($results ?? []); $index++) {
            $results[$index] = array_merge($results[$index], array("user" => $conn->executeQuery("SELECT id, username FROM users WHERE id = :id", array("id" => $results[$index]["user_id"]))->fetchAssociative()));
        }
        return $results;
    }
}