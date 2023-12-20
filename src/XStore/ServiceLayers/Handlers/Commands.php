<?php

namespace XStore\ServiceLayers\Handlers;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use XStore\Adapters\Hashing\AbstractHashing;
use XStore\Domains\Commands\AdminLoginCommand;
use XStore\Domains\Commands\CreateNewAdminCommand;
use XStore\Domains\Commands\CreateNewUserCommand;
use XStore\Domains\Commands\InitialAdminCommand;
use XStore\Domains\Events\CreatedUserEvent;
use XStore\Domains\Models\User;
use XStore\ServiceLayers\UnitOfWork\AbstractUnitOfWork;
use XStore\Domains\Commands\UserLoginCommand;
use XStore\Domains\Events\CreatedAdminEvent;
use XStore\Domains\Models\Admin;
use XStore\ServiceLayers\Exceptions\EmailExistedException;
use XStore\ServiceLayers\Exceptions\InvalidPasswordException;
use XStore\ServiceLayers\Exceptions\NotFoundException;
use XStore\ServiceLayers\Exceptions\RootWasInitiatedException;
use XStore\ServiceLayers\Exceptions\UsernameExistedException;
use XStore\Domains\Commands\AddProductToCartCommand;
use XStore\Domains\Commands\CancelOrderCommand;
use XStore\Domains\Models\OrderStatus;
use XStore\Domains\Models\Order;
use XStore\Domains\Models\OrderProduct;
use XStore\Domains\Models\Property;
use XStore\Domains\Commands\DeleteCartProductCommand;
use XStore\Domains\Commands\UpdateCartProductCommand;
use XStore\Domains\Commands\CreateOrderCommand;
use XStore\Domains\Commands\UpdateOrderCommand;
use XStore\Domains\Models\Address;
use XStore\Domains\Models\TypeShippingFee;
use XStore\ServiceLayers\Exceptions\OutStockException;
use XStore\ServiceLayers\Exceptions\ForbiddenException;
use XStore\Domains\Commands\AddAddressCommand;
use XStore\Domains\Commands\DeleteAddressCommand;
use XStore\Domains\Commands\UpdateAddressCommand;

function createNewAdmin(CreateNewAdminCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var Admin $model */
    $model = $repo->get(Admin::class, array("username" => strtolower($command->getUsername())));
    if ($model != null) {
        throw new UsernameExistedException();
    }
    $uow->beginTransaction();
    $passwordHash = $hashing->hash($command->getPassword());
    $model = new Admin(
        username: strtolower($command->getUsername()),
        password: $passwordHash,
        email: $command->getEmail() == null ? null : strtolower($command->getEmail())
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedAdminEvent($model->getId());
    $model->setEvents(array($event));
}

function createNewUser(CreateNewUserCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => strtolower($command->getEmail())));
    if ($model != null) {
        throw new EmailExistedException();
    }
    $model = $repo->get(User::class, array("username" => strtolower($command->getUsername())));
    if ($model != null) {
        throw new UsernameExistedException();
    }
    $uow->beginTransaction();
    $passwordHash = $hashing->hash($command->getPassword());
    $model = new User(
        username: strtolower($command->getUsername()),
        email: strtolower($command->getEmail()),
        password: $passwordHash,
    );
    $repo->add($model);
    $uow->commit();
    $event = new CreatedUserEvent($model->getId());
    $model->setEvents(array($event));
}

function loginUser(UserLoginCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var User $model */
    $model = $repo->get(User::class, array("email" => strtolower($command->getIdentify())));
    if ($model == null) {
        /** @var User $model */
        $model = $repo->get(User::class, array("username" => strtolower($command->getIdentify())));
    }
    if ($model == null) {
        throw new NotFoundException();
    }
    if (!$hashing->compare($command->getPassword(), $model->getPassword())) {
        throw new InvalidPasswordException();
    }
}

function loginAdmin(AdminLoginCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var Admin $model */
    $model = $repo->get(Admin::class, array("username" => strtolower($command->getIdentify())));
    if ($model == null) {
        throw new NotFoundException();
    }
    if (!$hashing->compare($command->getPassword(), $model->getPassword())) {
        throw new InvalidPasswordException();
    }
}

function initialAdmin(InitialAdminCommand $command, AbstractUnitOfWork $uow, AbstractHashing $hashing): void
{
    $repo = $uow->getRepository();
    /** @var Admin $model */
    $model = $repo->get(Admin::class, array("username" => "root"));
    if ($model != null) {
        throw new RootWasInitiatedException();
    }
    $uow->beginTransaction();
    $passwordHash = $hashing->hash($command->getPassword());
    $model = new Admin(
        username: "root",
        password: $passwordHash,
        isRoot: true
    );
    $repo->add($model);
    $uow->commit();
}

function addProductToCart(AddProductToCartCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }
    /** @var Order $order */
    $order = $repo->get(Order::class, array("user" => $user, "status" => OrderStatus::INCARD));
    if ($order == null) {
        $order = new Order(
            user: $user,
            address: null,
            typeShippingFee: TypeShippingFee::OTHER_SHIPPING,
            status: OrderStatus::INCARD
        );
        $repo->add($order);
    }
    /** @var Property $property */
    $property = $repo->get(Property::class, array("id" => $command->getPropertyId()));
    if ($property == null) {
        throw new NotFoundException();
    }

    if ($command->getNumber() > $property->getNumber()) {
        throw new OutStockException();
    }
    /** @var OrderProduct $model */
    $order_product = new OrderProduct(
        order: $order,
        property: $property,
        number: $command->getNumber()
    );
    $repo->add($order_product);
    $uow->commit();
}

function deleteCartProduct(DeleteCartProductCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }

    /** @var Order $order */
    $order = $repo->get(Order::class, array("user" => $user, "status" => OrderStatus::INCARD));

    if ($order == null) {
        throw new NotFoundException();
    }

    /** @var Property $property */
    $property = $repo->get(Property::class, array("id" => $command->getPropertyId()));
    if ($property == null) {
        throw new NotFoundException();
    }

    /** @var OrderProduct $order_product */
    $repo->remove(OrderProduct::class, array("property" => $property, "order" => $order));


    $uow->commit();
}

function updateCartProduct(UpdateCartProductCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }
    /** @var Order $order */
    $order = $repo->get(Order::class, array("user" => $user, "status" => OrderStatus::INCARD));

    if ($order == null) {
        throw new NotFoundException();
    }
    /** @var Property $property */
    $property = $repo->get(Property::class, array("id" => $command->getPropertyId()));
    if ($property == null) {
        throw new NotFoundException();
    }
    if ($command->getNumber() == 0) {
        /** @var OrderProduct $order_product */
        $repo->remove(OrderProduct::class, array("property" => $property, "order" => $order));
        $uow->commit();
    } else {
        if ($command->getNumber() > $property->getNumber()) {
            throw new OutStockException();
        }
        /** @var OrderProduct $model */
        $model = $repo->get(
            OrderProduct::class,
            array("property" => $property, "order" => $order)
        );
        if ($model == null) {
            throw new NotFoundException();
        }
        $model->setNumber($command->getNumber());
        $repo->add($model);
        $uow->commit();
    }
}

function createOrder(CreateOrderCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }

    /** @var Address $address */
    $address = $repo->get(Address::class, array("id" => $command->getAddressId(), "user" => $user));
    if ($address == null) {
        throw new NotFoundException();
    }

    $location = $address->getAddress();

    if ($location == null) {
        throw new NotFoundException();
    }

    $typeShippingFee = TypeShippingFee::OTHER_SHIPPING;
    if (
        strpos($location, "Hà Nội") !== false || strpos($location, "Hanoi") !== false ||
        strpos($location, "hanoi") !== false || strpos($location, "hà nội") !== false
    ) {
        $typeShippingFee = TypeShippingFee::LOCAL_SHIPPING;
    }

    /** @var Order $model */
    $order = new Order(
        user: $user,
        address: $address,
        typeShippingFee: $typeShippingFee,
        status: OrderStatus::PENDING
    );
    $repo->add($order);

    foreach ($command->getProducts() as $product) {
        /** @var Property $property */
        $property = $repo->get(Property::class, array("id" => $product['property_id']));
        if ($property == null) {
            throw new NotFoundException();
        }
        if ($product['number'] > $property->getNumber()) {
            throw new OutStockException();
        }
        /** @var OrderProduct $model */
        $order_product = new OrderProduct(
            order: $order,
            property: $property,
            number: $product['number']
        );
        $repo->add($order_product);
        $property->setNumber($property->getNumber() - $product['number']);
        $repo->add($property);
    }
    $uow->commit();
}

function updateOrder(UpdateOrderCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }
    /** @var Address $address */
    $address = $repo->get(Address::class, array("id" => $command->getAddressId(), "user" => $user));
    if ($address == null) {
        throw new NotFoundException();
    }
    $location = $address->getAddress();

    if ($location == null) {
        throw new NotFoundException();
    }

    $typeShippingFee = TypeShippingFee::OTHER_SHIPPING;
    if (
        strpos($location, "Hà Nội") !== false || strpos($location, "Hanoi") !== false ||
        strpos($location, "hanoi") !== false || strpos($location, "hà nội") !== false
    ) {
        $typeShippingFee = TypeShippingFee::LOCAL_SHIPPING;
    }

    /** @var Order $order */
    $order = $repo->get(Order::class, array("id" => $command->getOrderId()));
    if ($order == null) {
        throw new NotFoundException();
    }
    if ($order->getUser()->getId() != $user->getId()) {
        throw new ForbiddenException();
    }
    if ($order->getStatus() != OrderStatus::PENDING) {
        throw new ForbiddenException();
    }
    $order->setAddress($address);
    $order->setTypeShippingFee($typeShippingFee);
    $repo->add($order);
    $uow->commit();
}

function cancelOrder(CancelOrderCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }
    /** @var Order $order */
    $order = $repo->get(Order::class, array("id" => $command->getOrderId()));
    if ($order == null) {
        throw new NotFoundException();
    }
    if ($order->getUser()->getId() != $user->getId()) {
        throw new ForbiddenException();
    }
    if ($order->getStatus() != OrderStatus::PENDING) {
        throw new ForbiddenException();
    }
    $order->setStatus(OrderStatus::CANCELED);
    $repo->add($order);

    $order_product = $repo->getAll(OrderProduct::class, array("order" => $order));

    foreach ($order_product as $product) {
        /** @var Property $property */
        $property = $product->getProperty();
        $property->setNumber($property->getNumber() + $product->getNumber());
        $repo->add($property);
    }
    $uow->commit();
}

function addAddress(AddAddressCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }
    $address = new Address(
        user: $user,
        firstName: $command->getFirstName(),
        lastName: $command->getLastName(),
        phoneNumber: $command->getPhoneNumber(),
        address: $command->getAddress(),
        email: $command->getEmail(),
        defaultAddress: $command->getDefaultAddress()
    );
    $repo->add($address);
    $uow->commit();
}

function deleteAddress(DeleteAddressCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }
    /** @var Address $address */
    $address = $repo->get(Address::class, array("id" => $command->getAddressId(), "user" => $user));
    if ($address == null) {
        throw new NotFoundException();
    }
    $repo->remove(Address::class, array("id" => $command->getAddressId()));
    $uow->commit();
}

function updateAddress(UpdateAddressCommand $command, AbstractUnitOfWork $uow): void
{
    $repo = $uow->getRepository();
    $uow->beginTransaction();
    /** @var User $model */
    $user = $repo->get(User::class, array("id" => $command->getUserId()));
    if ($user == null) {
        throw new NotFoundException();
    }
    /** @var Address $address */
    $address = $repo->get(Address::class, array("id" => $command->getAddressId(), "user" => $user));
    if ($address == null) {
        throw new NotFoundException();
    }
    if ($command->getFirstName() != null) {
        $address->setFirstName($command->getFirstName());
    }
    if ($command->getLastName() != null) {
        $address->setLastName($command->getLastName());
    }

    if ($command->getPhoneNumber() != null) {
        $address->setPhoneNumber($command->getPhoneNumber());
    }

    if ($command->getAddress() != null) {
        $address->setAddress($command->getAddress());
    }

    if ($command->getEmail() != null) {
        $address->setEmail($command->getEmail());
    }

    if ($command->getDefaultAddress() != null) {
        $address->setDefaultAddress($command->getDefaultAddress());
    }


    $repo->add($address);
    $uow->commit();
}

const COMMAND_HANDLERS = array(
    CreateNewUserCommand::class => "XStore\ServiceLayers\Handlers\createNewUser",
    UserLoginCommand::class => "XStore\ServiceLayers\Handlers\loginUser",
    CreateNewAdminCommand::class => "XStore\ServiceLayers\Handlers\createNewAdmin",
    AdminLoginCommand::class => "XStore\ServiceLayers\Handlers\loginAdmin",
    InitialAdminCommand::class => "XStore\ServiceLayers\Handlers\initialAdmin",
    AddProductToCartCommand::class => "XStore\ServiceLayers\Handlers\addProductToCart",
    DeleteCartProductCommand::class => "XStore\ServiceLayers\Handlers\deleteCartProduct",
    UpdateCartProductCommand::class => "XStore\ServiceLayers\Handlers\updateCartProduct",
    CreateOrderCommand::class => "XStore\ServiceLayers\Handlers\createOrder",
    UpdateOrderCommand::class => "XStore\ServiceLayers\Handlers\updateOrder",
    CancelOrderCommand::class => "XStore\ServiceLayers\Handlers\cancelOrder",
    AddAddressCommand::class => "XStore\ServiceLayers\Handlers\addAddress",
    DeleteAddressCommand::class => "XStore\ServiceLayers\Handlers\deleteAddress",
    UpdateAddressCommand::class => "XStore\ServiceLayers\Handlers\updateAddress",
);
