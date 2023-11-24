<?php

namespace XStore\Entrypoints\Mvc;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use XStore\Domains\Commands\CreateUserCommand;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;

use function XStore\bootstrap;
use function XStore\get_mysql_info;


require_once __DIR__ . "/../../Configs.php";
require_once __DIR__ . "/../../Bootstrap.php";

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/../../Adapters"),
    isDevMode: true,
);
$mysql_info = get_mysql_info();
$connection = DriverManager::getConnection(array_merge([
    'driver' => 'pdo_mysql',
], $mysql_info), $config);
// obtaining the entity manager
$entity_manager = new EntityManager($connection, $config);

$bus = bootstrap(new DoctrineUnitOfWork(
    $entity_manager
));

$bus->handle(new CreateUserCommand());