<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Adapters\Hashing\AbstractHashing;
use XStore\Domains\Commands\CreateNewUserCommand;
use XStore\Domains\Events\CreatedUserEvent;
use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;
use XStore\Domains\Commands\UserLoginCommand;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;
use XStore\ServiceLayers\Exceptions\NotFoundException;

require_once __DIR__ . "/../Utils.php";

function create_new_user(CreateNewUserCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $uow->begin_transaction();
    $repo = $uow->get_repo();
    /** @var User $model */
    $password_hash = $hashing->hash($command->get_password());
    $model = new User(
        username: $command->get_username(),
        email: $command->get_email(),
        password: $password_hash,
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedUserEvent($model->get_id());
    $model->set_events(array($event));
}

function login_user(UserLoginCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->get_repo();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => $command->get_email()));
    if ($model == null) {
        throw new NotFoundException();
    }
    if (!$hashing->compare($command->get_password(), $model->get_password())) {
        throw new InvalidPasswordException();
    }
}

const COMMAND_HANDLERS = array(
    CreateNewUserCommand::class => "XStore\ServiceLayers\Handlers\create_new_user",
    UserLoginCommand::class => "XStore\ServiceLayers\Handlers\login_user"
);
