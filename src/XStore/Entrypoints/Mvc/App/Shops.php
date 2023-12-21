<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="/assets/app/js/cart.js"></script>
</head>

<body>
    <?php

    use Doctrine\DBAL\Schema\View;
    use XStore\Domains\Models\User;
    use XStore\X\Jw\Jwt;
    use XStore\Configs;
    use XStore\Domains\Models\Product;
    use XStore\Domains\Models\Property;
    use XStore\Views;

    use function XStore\bootstrap;

    require_once __DIR__ . "/../Common/Header.php";
    require_once __DIR__ . "/../../../Bootstrap.php";

    $bus = bootstrap();
    /**
     * @var DoctrineUnitOfWork $uow
     */
    $uow = $bus->getUow();
    $repo = $uow->getRepository();

    if (isset($_COOKIE["accessToken"])) {
        /**
         * @var string $accessToken
         */
        $accessToken = $_COOKIE["accessToken"];
        try {
            $payload = (new Jwt(Configs::getSecretKey()))->decode($accessToken);
            $id = (int)$payload["id"];
            /**
             * @var User $currentUser
             */
            $currentUser = $repo->get(User::class, array("id" => $id));
            if ($currentUser == null) {
                http_response_code(302);
                header("Location: /login");
                exit;
            }
            define("CURRENT_USER", $currentUser->getUsername());

            define("CURRENT_USER_ID", $currentUser->getId());
        } catch (Exception $e) {
            http_response_code(302);
            header("Location: /login");
            exit;
        }
    } else {
        header("Location: /login");
        exit();
    }
    ?>


    <div class="cart-page">
        <div class="container">
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th class="product-h">Product</th>
                            <th>Price</th>
                            <th class="quan">Quantity</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $product_in_cart = Views::getCartProductByUserId($bus->getUow(), CURRENT_USER_ID);
                        $sum_total_cart = 0;
                        for ($index = 0; $index < sizeof($product_in_cart ?? []); $index++) {
                            $product = $product_in_cart[$index];
                            $property_id = $product["property_id"];
                            /**
                             * @var Property $property
                             */
                            $property = $repo->get(Property::class, array("id" => $property_id));

                            $sum_total_cart += ($property->getPrice()) * ($product['number']);
                            echo '
                            <tr>
                            <td class="product-select">
                                <label>
                                    <input type="checkbox">
                                    <span></span>
                                </label>
                            </td>
                            <td class="product-col">

                                <img src="' . ($property->getPath() ?? $property->getProduct()->getPath()) . '" alt=""/>

                                <div class="p-title">
                                    <h5>' . ($property->getProduct()->getName() ?? "") . '</h5>
                                </div>
                            </td>
                            <td class="price-col">' . ($property->getPrice()) . '</td>
                            <td class="quantity-col">
                                <div class="pro-qty">
                                    <button class=" btn minus" style="font-size: 24px;" onclick="minusCart(' . $property_id . ',' . $product['number'] . ')">-</button>
                                    <input type="text" value=' . ($product["number"]) . '>
                                    <button class=" btn plus" style="font-size: 24px;" onclick="plusCart(' . $property_id . ',' . $product['number'] . ')">+</button>
                                </div>
                            </td>
                            <td class="color-col">' . $property->getColor() . '</td>
                            <td class="size-col">' . $property->getSizeId() . '</td>
                            <td class="total">' . ($property->getPrice()) * ($product['number']) . '</td>
                            <td class="product-close">
                                <button class=" btn close" style="font-size: 24px;" onclick="removeFromCart(' . $property_id . ')">x</button>
                            </td>
                        </tr>';
                        }
                        ?>

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
                                    <td class="total-cart">Total Cart</td>
                                </tr>

                                <tr>
                                    <?php
                                    echo '<td class="total-cart">' . $sum_total_cart . '</td>'
                                    ?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <a href="/checkout" class="primary-btn chechout-btn">Purchase</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>