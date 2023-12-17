<?php

namespace XStore;

use Symfony\Component\Cache\DoctrineProvider;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\X\Jw\AbstractJwt;
use XStore\Domains\Models\OrderStatus;

class Views
{
    private function __construct()
    {
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
            "status_order" => OrderStatus::INCARD
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
}
