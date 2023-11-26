<?php

namespace XStore;

use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;

function get_user_by_id(DoctrineUnitOfWork $uow, int $id): mixed
{
    $sql = "SELECT ID, CREATED_AT, UPDATED_AT FROM USERS WHERE ID = :id;";
    $conn = $uow->get_entity_manager()->getConnection();
    $params = [
        "id" => $id
    ];
    $results = $conn->executeQuery($sql, $params)->fetchAllAssociative();
    return $results;
}
