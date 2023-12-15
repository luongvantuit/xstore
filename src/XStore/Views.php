<?php

namespace XStore;

use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\X\Jw\AbstractJwt;

class Views
{
    private function __construct()
    {
    }

    public static function get_user_by_id(DoctrineUnitOfWork $uow, int $id): array | null
    {
        $sql = "SELECT id, email, username FROM users WHERE id = :id;";
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

    public static function get_user_by_email(DoctrineUnitOfWork $uow, string $email): array | null
    {
        $sql = "SELECT id, email, username FROM users WHERE email = :email;";
        $conn = $uow->get_entity_manager()->getConnection();
        $params = [
            "email" => $email
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        return $result;
    }

    public static function get_jwt_token_of_user(DoctrineUnitOfWork $uow, int $user_id, AbstractJwt $jwt): string|null
    {
        $sql = "SELECT id, email, username FROM users WHERE id = :id;";
        $conn = $uow->get_entity_manager()->getConnection();
        $params = [
            "id" => $user_id
        ];
        $result = $conn->executeQuery($sql, $params)->fetchAssociative();
        if (!$result) {
            return null;
        }
        $payload = [
            "id" => $result["id"],
            "username" => $result["username"],
            "email" => $result["email"]
        ];
        return $jwt->encode($payload);
    }
}
