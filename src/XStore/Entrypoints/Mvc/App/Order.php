<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XStore - Order</title>
    <?php
    require_once __DIR__ . "/../Common/Links.php";
    ?>
</head>

<body>
    <?php
    require_once __DIR__ . "/../Common/Header.php";
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

    ?>

    <?php

    use XStore\Domains\Models\OrderStatus;
    use XStore\Domains\Models\User;
    use XStore\Views;
    use XStore\X\Jw\Jwt;
    use XStore\Configs;
    use XStore\Domains\Models\Order;
    use \XStore\Domains\Models\OrderProduct;
    use \XStore\Domains\Models\Property;

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
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        http_response_code(302);
        header("Location: /orders");
        exit;
    } else {
        /**
         * @var Order $currentOrder
         */
        $currentOrder = $repo->get(Order::class, array("id" => (int) $_GET["id"]));
        if ($currentOrder == null) {
            http_response_code(302);
            header("Location: /orders");
            exit;
        }
    }
    ?>

    <?php
    require_once __DIR__ . "/../Common/Header.php";
    ?>
    <!-- Search model -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>


    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Information Order<span>.</span></h2>
                        <p class="h3 btn rounded-fill btn-primary">
                            <?php echo convertOrderStatus($currentOrder->getStatus()->value) ?>
                        </p>
                    </div>
                </div>
                <!-- <div class="col-lg-8">
                    <img src="img/add.jpg" alt="">
                </div> -->
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Cart Total Page Begin -->
    <section class="cart-total-page spad">
        <div class="container">
            <div class="col-lg-12">
                <h3>Your Address</h3>
                <?php
                $order_id = (int) $_GET["id"];
                /**
                 * @var Order $order
                 */
                $order = $repo->get(Order::class, array(
                    "id" => (int) $order_id, "user" => $currentUser->getId()
                ));
                if ($order == null) {
                    http_response_code(302);
                    header("Location: /orders");
                    exit;
                }
                $address = $order->getAddress();
                ?>
                <div class="d-flex flex-column ml-3 text-secondary">
                    <span>
                        <?php echo $address->getFirstName() . " " . $address->getLastName(); ?>
                    </span>
                    <span>
                        <?php echo $address->getAddress(); ?>
                    </span>

                    <span>
                        <?php echo $address->getPhoneNumber(); ?>
                    </span>
                    <span>
                        <?php echo $address->getEmail() ?? $currentUser->getEmail(); ?>
                    </span>

                </div>

            </div>
        </div>

        <div class="cart-page" style=" margin-top: 20px;">
            <div class="container">
                <div class="cart-table">
                    <table>
                        <thead>

                            <div class="col-lg-12">
                                <h3>Product</h3>
                            </div>

                        </thead>
                        <tbody>
                            <?php
                            /**
                             * @var array  $product_in_order
                             */
                            $product_in_order = $repo->getAll(OrderProduct::class, array(
                                "order" => (int) $order_id
                            ));

                            error_log("" . $product_in_order[0]->getProperty()->getProduct()->getName(), LOG_INFO);
                            error_log(sizeof($product_in_order), LOG_INFO);
                            $sum_total_cart = 0;
                            foreach (($product_in_order ?? []) as $_product) :
                                $property = $_product->getProperty();
                                error_log("" . $property->getProduct()->getName(), LOG_INFO);

                                $sum_total_cart += ($property->getPrice()) * $_product->getNumber();
                                $sizeId = $property->getSizeId();
                                $size = '';
                                if ($sizeId == 1) {
                                    $size = 'M';
                                } else if ($sizeId == 2) {
                                    $size = 'L';
                                } else if ($sizeId == 3) {
                                    $size = 'XL';
                                } else {
                                    $size = 'Free Size';
                                }
                            ?>
                                <tr>
                                    <td class="product-col">
                                        <img src="<?php echo ($property->getPath() ?? $property->getProduct()->getPath()) ?>" alt="" />
                                        <div class="p-title">
                                            <h5><?php echo $property->getProduct()->getName() ?? "" ?></h5>
                                        </div>
                                    </td>
                                    <td class="table-space"><strong style="font-size: 18px;"><?php echo ($property->getPrice())  ?></strong></td>
                                    <td class="quantity-col table-space">

                                        <div class="pro-qty">

                                            <input type="text" value="<?php echo $_product->getNumber() ?>" disabled>
                                        </div>
                                    </td>
                                    <td class="table-space"><i class="fa-solid fa-circle" style="color: <?php echo $property->getColor() ?>;"></i></td>
                                    <td class="table-space"><?php echo $size ?></td>

                                    <td class="table-space"><strong style="font-size: 18px;"><?php ($property->getPrice()) * ($_product->getNumber()) ?></strong></td>
                                </tr>

                            <?php endforeach; ?>
                            <tr>
                                <td class="product-col">
                                    <img src="/assets/img/icons/ship.jpg" alt="">

                                    <div class="p-title">
                                        <h5>Shipping Fee</h5>
                                    </div>
                                </td>
                                <td class="price-col">25000</td>
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="shopping-method">
                <div class="container">
                    <div class="total-info">
                        <div class="total-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td class="total-cart">Total</td>
                                    </tr>

                                    <tr>
                                        <td class="total-cart"><?php echo ($sum_total_cart + 25000) ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <?php
                                if ($order->getStatus() == OrderStatus::PENDING) : ?>
                                    <button id="btn-cancel" class="primary-btn chechout-btn">Cancel Order</button>
                                <?php elseif ($order->getStatus() == OrderStatus::DELIVERED) : ?>
                                    <button id="btn-return" class="primary-btn chechout-btn">Return Order</button>
                                <?php else : ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Total Page End -->
    <!-- Footer Section End -->

    <!-- Js Plugins -->

    <?php
    require_once __DIR__ . "/../Common/Footer.php";
    require_once __DIR__ . "/../Common/Scripts.php";
    ?>

    <script>
        $(document).ready(function() {

            $("#btn-cancel").click(function() {
                fetch("/api/orders?order_id=<?php echo $order->getId() ?>", {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken') || ''
                    }
                }).then(function(response) {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            });
            $("#btn-return").click(function() {
                fetch("/api/admin/orders", {
                    method: "PUT",
                    body: JSON.stringify({
                        id: Number(<?php echo $order->getId() ?>),
                        status: "returning"
                    }),
                    headers: {
                        "Content-Type": "application/json",
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken') || ''
                    }
                }).then(function(response) {
                    if (response.ok) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>

</body>

</html>