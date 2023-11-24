<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Domains\Commands\CreateUserCommand;
use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;

require_once __DIR__ . "/../../Adapters/Orm.php";

function create_user(CreateUserCommand $command, AbstractUnitOfWork $uow)
{
    $user = new User();
    $uow->get_repo()->add($user);
    $uow->commit();
}

const COMMAND_HANDLERS = array(
    CreateUserCommand::class => "XStore\ServiceLayers\Handlers\create_user"
);