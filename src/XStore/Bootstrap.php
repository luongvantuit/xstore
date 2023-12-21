<?php

namespace XStore;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use ReflectionFunction;
use XStore\Adapters\Hashing\BcryptHashing;
use XStore\Adapters\Notifications\PhpMailerNotification;
use XStore\ServiceLayers\MessageBus;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\X\MappersSingleton;

use function XStore\Adapters\start_mappers;

use const XStore\ServiceLayers\Handlers\COMMAND_HANDLERS;
use const XStore\ServiceLayers\Handlers\EVENT_HANDLERS;

require_once __DIR__ . "/Adapters/Orm.php";
require_once __DIR__ . "/ServiceLayers/Handlers/Commands.php";
require_once __DIR__ . "/ServiceLayers/Handlers/Events.php";

function bootstrap(): MessageBus
{
    # Dependencies pattern
    $dependencies = array(
        "hashing" => new BcryptHashing(),
        "emailNotification" => new PhpMailerNotification()
    );
    // Mappers
    if (!MappersSingleton::getInstance()->created) {
        MappersSingleton::getInstance()->created = true;
        start_mappers();
    }
    // Initial unit of work
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: [
            __DIR__ . "/Domains/Models"
        ],
        isDevMode: true,
    );
    $mysql_info = Configs::getMysqlInfo();
    $connection = DriverManager::getConnection(array_merge([
        'driver' => 'pdo_mysql',
    ], $mysql_info), $config);
    // obtaining the entity manager
    $entity_manager = new EntityManager($connection, $config);
    $uow = new DoctrineUnitOfWork($entity_manager);
    // Extend unit of work
    $dependencies = array_merge($dependencies, array("uow" => $uow));
    # Inject event handlers
    $injectedEventHandlers = array_map(function ($eventHandlers) use ($dependencies) {
        return array_map(function ($handler) use ($dependencies) {
            return injectDependencies($handler, $dependencies);
        }, $eventHandlers);
    }, EVENT_HANDLERS);
    # Inject command handlers
    $injectedCommandHandlers = array_map(function ($handler) use ($dependencies) {
        return injectDependencies($handler, $dependencies);
    }, COMMAND_HANDLERS);
    return new MessageBus(
        uow: $uow,
        eventHandlers: $injectedEventHandlers,
        commandHandlers: $injectedCommandHandlers,
    );
}

function injectDependencies($handler, $dependencies): callable
{
    $reflection = new ReflectionFunction($handler);
    $params = $reflection->getParameters();
    $deps = array_intersect_key($dependencies, array_flip(array_map(function ($param) {
        error_log($param, LOG_INFO);
        return $param->name;
    }, $params)));
    return function ($message) use ($handler, $deps) {
        return call_user_func_array($handler, array_merge([$message], $deps));
    };
}
