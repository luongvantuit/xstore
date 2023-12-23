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
    use XStore\X\Jw\Jwt;
    use XStore\Configs;
    use XStore\Domains\Models\Order;
    use \XStore\Domains\Models\OrderProduct;
    use \XStore\Domains\Models\Admin;

    use function XStore\bootstrap;

    require_once __DIR__ . "/../../../Bootstrap.php";

    $bus = bootstrap();
    /**
     * @var DoctrineUnitOfWork $uow
     */
    $uow = $bus->getUow();
    $repo = $uow->getRepository();
    /**
     * @var Admin $model
     */
    $model = $repo->get(Admin::class, array("username" => "root"));
    if ($model == null) {
        http_response_code(302);
        header("Location: /admin/initial-root-password");
        exit;
    }

    if (isset($_COOKIE["adminAccessToken"])) {
        /**
         * @var string $accessToken
         */
        $accessToken = $_COOKIE["adminAccessToken"];
        try {
            $payload = (new Jwt("admin" . Configs::getSecretKey()))->decode($accessToken);
            $adminId = (int) $payload["id"];
            /**
             * @var Admin $currentAdmin
             */
            $currentAdmin = $repo->get(Admin::class, array("id" => $adminId));
            if ($currentAdmin == null) {
                http_response_code(302);
                header("Location: /admin/login");
                exit;
            }
        } catch (\Exception $e) {
            error_log($e, LOG_INFO);
            http_response_code(302);
            header("Location: /admin/login");
            exit;
        }
    } else {
        http_response_code(302);
        header("Location: /admin/order");
        exit;
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
                <h3>Order Address</h3>
                <?php
                $order_id = (int) $_GET["id"];
                /**
                 * @var Order $order
                 */
                $order = $currentOrder;
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
                        <?php echo $address->getEmail() ?? $order->getUser()->getEmail(); ?>
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


                            foreach (($product_in_order ?? []) as $_product) {
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

                                echo '
                                <tr>
                                <td class="product-col">
                                    <img src="' . ($property->getPath() ?? $property->getProduct()->getPath()) . '" alt=""/>
                                    <div class="p-title">
                                        <h5>' . ($property->getProduct()->getName() ?? "") . '</h5>
                                    </div>
                                </td>
                                <td class="table-space"><strong style="font-size: 18px;">' . ($property->getPrice()) . '</strong></td>
                                <td class="quantity-col table-space">
                             
                                    <div class="pro-qty">
            
                                        <input type="text" value=' . ($_product->getNumber()) . ' disabled>
                                        </div>
                                </td>
                                <td class="table-space"><i class="fa-solid fa-circle" style="color: ' . $property->getColor() . ';"></i></td>
                                <td class="table-space">' . $size . '</td>
                                
                                <td class="table-space"><strong style="font-size: 18px;">' . ($property->getPrice()) * ($_product->getNumber()) . '</strong></td>
                            </tr>';
                            }

                            ?>
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


</body>

</html>