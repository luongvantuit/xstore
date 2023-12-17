<?php

namespace XStore;

use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\X\Jw\AbstractJwt;

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
}
