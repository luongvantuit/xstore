<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XStore - Carts</title>
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
                            <th>Select</th>
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
                        $product_in_cart = Views::getCartProductByUserId($bus->getUow(), (int) CURRENT_USER_ID);
                        $sum_total_cart = 0;
                        for ($index = 0; $index < sizeof($product_in_cart ?? []); $index++) {
                            $product = $product_in_cart[$index];
                            $property_id = $product["property_id"];
                            /**
                             * @var Property $property
                             */
                            $property = $repo->get(Property::class, array("id" => $property_id));

                            $sum_total_cart += ($property->getPrice()) * ($product['number']);
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
                                <td class="table-space px-3">
                                    <label>
                                        <input type="checkbox" id="checkbox-select-' . $property->getId() . '" class="product-select-checkout">
                                    </label>
                                </td>
                                <td class="product-col">
                                    <img src="' . ($property->getPath() ?? $property->getProduct()->getPath()) . '" alt=""/>
                                    <div class="p-title">
                                        <h5>' . ($property->getProduct()->getName() ?? "") . '</h5>
                                    </div>
                                </td>
                                <td class="table-space"><strong style="font-size: 18px;">' . ($property->getPrice()) . '</strong></td>
                                <td class="quantity-col table-space">
                                    <div class="pro-qty">
                                        <button class="btn minus" style="font-size: 24px;" onclick="minusCart(' . $property_id . ',' . ($product['number']) . ')">-</button>
                                        <input type="text" value=' . ($product["number"]) . ' disabled>
                                        <button class="btn plus" style="font-size: 24px;" onclick="plusCart(' . $property_id . ',' . ($product['number']) . ')">+</button>
                                    </div>
                                </td>
                                <td class="table-space"><i class="fa-solid fa-circle" style="color: ' . $property->getColor() . ';"></i></td>
                                <td class="table-space">' . $size . '</td>
                                
                                <td class="table-space"><strong style="font-size: 18px;">' . ($property->getPrice()) * ($product['number']) . '</strong></td>
                                <td class="table-space">
                                    <button class="btn text-gray-600" onclick="removeFromCart(' . $property_id . ')"><i class="fa-solid fa-xmark"></i></button>
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
                            <a class="primary-btn chechout-btn">Purchase</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once __DIR__ . "/../Common/Footer.php";
    require_once __DIR__ . "/../Common/Scripts.php";
    ?>
    <script src="/assets/app/js/cart.js"></script>
    <script>
        $(document).ready(function() {
            var product_is_select = [];

            $('.product-select-checkout').change(function() {
                if ($(this).is(':checked')) {
                    var propertyId = $(this).attr('id').replace('checkbox-select-', '');
                    product_is_select.push(propertyId);
                } else {
                    var propertyId = $(this).attr('id').replace('checkbox-select-', '');
                    if (product_is_select.includes(propertyId)) {
                        product_is_select.splice(product_is_select.indexOf(propertyId), 1);
                    }
                }
            });

            $('.chechout-btn').click(function(e) {
                e.preventDefault();
                localStorage.setItem('product_is_select', JSON.stringify(product_is_select));
                window.location.href = '/checkout?product_is_select=' + product_is_select.join(',');
            });
        });
    </script>
    < /html>