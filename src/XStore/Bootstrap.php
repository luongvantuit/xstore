<?php

namespace XStore;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use ReflectionFunction;
use XStore\ServiceLayers\MessageBus;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;

use function XStore\Adapters\start_mappers;

use const XStore\ServiceLayers\Handlers\COMMAND_HANDLERS;
use const XStore\ServiceLayers\Handlers\EVENT_HANDLERS;

require_once __DIR__ . "/Adapters/Orm.php";
require_once __DIR__ . "/ServiceLayers/Handlers/Commands.php";
require_once __DIR__ . "/ServiceLayers/Handlers/Events.php";

function bootstrap(): MessageBus
{
    // Mappers
    start_mappers();
    // Initial unit of work
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: [
            __DIR__ . "../Domains/Models"
        ],
        isDevMode: true,
    );
    $mysql_info = get_mysql_info();
    $connection = DriverManager::getConnection(array_merge([
        'driver' => 'pdo_mysql',
    ], $mysql_info), $config);
    // obtaining the entity manager
    $entity_manager = new EntityManager($connection, $config);
    $uow = new DoctrineUnitOfWork($entity_manager);
    # Dependencies pattern
    $dependencies = array("uow" => $uow);
    # Inject event handlers
    $injected_event_handlers = array_map(function ($event_handlers) use ($dependencies) {
        return array_map(function ($handler) use ($dependencies) {
            return inject_dependencies($handler, $dependencies);
        }, $event_handlers);
    }, EVENT_HANDLERS);
    # Inject command handlers
    $injected_command_handlers = array_map(function ($handler) use ($dependencies) {
        return inject_dependencies($handler, $dependencies);
    }, COMMAND_HANDLERS);
    return new MessageBus(
        uow: $uow,
        event_handlers: $injected_event_handlers,
        command_handlers: $injected_command_handlers,
    );
}

function inject_dependencies($handler, $dependencies): callable
{
    $reflection = new ReflectionFunction($handler);
    $params = $reflection->getParameters();
    $deps = array_intersect_key($dependencies, array_flip(array_map(function ($param) {
        return $param->name;
    }, $params)));
    return function ($message) use ($handler, $deps) {
        return call_user_func_array($handler, array_merge([$message], $deps));
    };
}