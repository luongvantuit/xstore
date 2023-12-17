<?php

namespace XStore\Adapters;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../Configs.php";

use Doctrine\ORM\Tools\SchemaTool;
use XStore\Configs;

function start_mappers(): void
{
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: array(__DIR__ . "/../Domains/Models"),
        isDevMode: true,
    );
    $mysql_info = Configs::getMysqlInfo();
    $connection = DriverManager::getConnection(array_merge([
        'driver' => 'pdo_mysql',
    ], $mysql_info), $config);
    // obtaining the entity manager
    $entity_manager = new EntityManager($connection, $config);
    $schema_tool = new SchemaTool($entity_manager);
    $metadata = $entity_manager->getMetadataFactory()->getAllMetadata();
    $schema_tool->updateSchema($metadata);
}
