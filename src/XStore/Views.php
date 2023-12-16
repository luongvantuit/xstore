<?php

namespace XStore;

use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\X\Jw\AbstractJwt;

class Views
{
    private function __construct()
    {
    }

    public static function get_user_by_id(DoctrineUnitOfWork $uow, int $id): array | null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM users WHERE id = :id;";
        $conn = $uow->get_entity_manager()->getConnection();
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

    public static function get_user_by_email(DoctrineUnitOfWork $uow, string $email): array|null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM users WHERE email = :email;";
        $conn = $uow->get_entity_manager()->getConnection();
        $params = [
            "email" => strtolower($email)
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function get_user_by_identify(DoctrineUnitOfWork $uow, string $identify): array | null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM users WHERE email = :email OR username = :username;";
        $conn = $uow->get_entity_manager()->getConnection();
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

    public static function get_jwt_token_of_user(DoctrineUnitOfWork $uow, int $user_id, AbstractJwt $jwt): string|null
    {
        $sql = "SELECT id, email, username, created_at, updated_at FROM users WHERE id = :id;";
        $conn = $uow->get_entity_manager()->getConnection();
        $params = [
            "id" => $user_id
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $jwt->encode($result);
    }
}
