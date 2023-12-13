<?php

namespace XStore\ServiceLayers\Handlers;

use XStore\Domains\Commands\CreateUserCommand;
use XStore\Domains\Events\CreatedUserEvent;
use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;
use XStore\Domains\Commands\LoginCommand;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;
use XStore\ServiceLayers\Exceptions\NotFoundException;

use function XStore\ServiceLayers\encodePassword;
use function XStore\ServiceLayers\verifyPassword;

require_once __DIR__ . "/../Utils.php";

function create_user(CreateUserCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->get_repo();
    /** @var User $model */
    $password_hash = encodePassword($command->get_password());
    $model = new User(
        password: $password_hash,
        username: $command->get_username(),
        email: $command->get_email()
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedUserEvent($model->get_id());
    $model->set_events(array($event));
}

function login_user(LoginCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->get_repo();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => $command->get_email()));

    if ($model == null && !$model instanceof User) {
        throw new NotFoundException();
    }
    if (!verifyPassword($command->get_password(), $model->get_password())) {
        throw new InvalidPasswordException();
    }
}

const COMMAND_HANDLERS = array(
    CreateUserCommand::class => "XStore\ServiceLayers\Handlers\create_user",
    LoginCommand::class => "XStore\ServiceLayers\Handlers\login_user"
);
