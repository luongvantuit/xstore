<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XStore - Orders</title>
    <?php
    require_once __DIR__ . "/../Common/Links.php";
    ?>
</head>

<body>
    <?php

    require_once __DIR__ . "/../Common/Header.php";
    ?>

    <?php

    use XStore\Domains\Models\User;
    use XStore\X\Jw\Jwt;
    use XStore\Configs;
    use XStore\Domains\Models\Order;
    use XStore\Domains\Models\Product;
    use XStore\Domains\Models\Property;
    use XStore\Views;

    use function XStore\bootstrap;

    require_once __DIR__ . "/../../../Bootstrap.php";

    $bus = bootstrap();
    /**
     * @var DoctrineUnitOfWork $uow
     */
    $uow = $bus->getUow();
    $repo = $uow->getRepository();
    $currentUser = null;
    if (isset($_COOKIE["accessToken"])) {
        /**
         * @var string $accessToken
         */
        $accessToken = $_COOKIE["accessToken"];
        try {
            $payload = (new Jwt(Configs::getSecretKey()))->decode($accessToken);
            $id = (int) $payload["id"];
            /**
             * @var User $currentUser
             */
            $currentUser = $repo->get(User::class, array("id" => $id));
            if ($currentUser == null) {
                http_response_code(302);
                header("Location: /login");
                exit;
            }
        } catch (Exception $e) {
            http_response_code(302);
            header("Location: /login");
            exit;
        }
    } else {
        header("Location: /login");
        exit();
    }

    function convertSizeId(int $sizeId): string
    {
        switch ($sizeId) {
            case 1:
                return 'M';
            case 2:
                return 'M';
            case 3:
                return 'XL';
            default:
                return 'Free Size';
        }
    }

    function convertOrderStatus(string $orderStatus): string
    {
        switch ($orderStatus) {
            case 'incard':
                return "In Cart";
            case 'pending':
                return "Pending";
            case 'cancelled':
                return "Cancelled";
            case 'delivering':
                return "Delivering";
            case 'delivered':
                return "Delivered";
            case 'returning':
                return "Returning";
            case 'returned':
                return "Returned";
            default:
                return "Error";
        }
    }

    $orders = Views::getOrdersByUserId($bus->getUow(), $currentUser->getId()) ?? [];
    ?>


    <div class="container mt-2">
        <?php if (sizeof($orders ?? []) > 0): ?>
            <?php foreach ($orders as $order_id => $order): ?>
                <?php
                $total_price_order = 0;
                $total_product = 0;
                // $first_product_id = $order["products"][0]["id"];
                $first_property_id = $order["products"][0]["property_id"];
                /**
                 * @var Order $origin_order
                 */
                $origin_order = $repo->get(Order::class, array("id" => (int) $order_id));

                /**
                 * @var Property $property
                 */
                $first_property = $repo->get(Property::class, array("id" => $first_property_id));
                /**
                 * @var Product $first_product
                 */
                $first_product = $first_property->getProduct();
                ?>
                <div class="row mt-2">
                    <a href="/order?id=<?php echo $order_id ?>" class="col p-3 shadow-sm rounded">
                        <?php foreach (($order["products"] ?? []) as $product): ?>
                            <?php
                            /**
                             * @var Property $property
                             */
                            $property = $repo->get(Property::class, array("id" => $product["property_id"]));
                            $total_price_order += ($property->getPrice()) * $product["number"];
                            ?>
                        <?php endforeach; ?>
                        <div class="d-flex w-100 justify-content-between">
                            <p class="">
                                <?php echo $origin_order->getCreatedAt()->format('l jS \o\f F Y h:i:s A') ?>
                            </p>
                            <p class="h3 btn rounded-fill btn-primary">
                                <?php echo convertOrderStatus($order["status"]) ?>
                            </p>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <div class="w-50 d-flex flex-row align-items-center justify-content-between">
                                <img class="w-25" src="<?php echo $first_product->getPath() ?>" alt="">
                                <div class="h4" style="color: black;">
                                    <?php echo $first_product->getName() ?>
                                </div>
                                <p>
                                    <?php echo 'x' . $product["number"] ?>
                                </p>
                            </div>

                            <div class=" w-50 d-flex flex-row align-items-center justify-content-center">
                                <div class="h4" style="color: black;">
                                    <?php echo $total_price_order ?>
                                </div>
                            </div>
                        </div>

                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="w-100 d-flex flex-column justify-content-center align-items-center mt-5">
                <img src="/assets/img/svgs/undraw_pancakes.svg" alt="" class="w-50">
                <p class="h3 my-3">
                    You have no orders!
                </p>
                <a href="/products" class="btn btn-dark">Go To Shopping</a>
            </div>
        <?php endif ?>
    </div>

    <?php
    require_once __DIR__ . "/../Common/Footer.php";
    require_once __DIR__ . "/../Common/Scripts.php";
    ?>
</body>

</html>