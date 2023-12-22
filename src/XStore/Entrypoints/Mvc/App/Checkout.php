<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Violet | Checkout</title>
    <?php

    use Doctrine\DBAL\Schema\View;
    use XStore\Domains\Models\Property;
    use XStore\Views;
    use XStore\Domains\Models\User;
    use XStore\X\Jw\Jwt;
    use XStore\Configs;
    use function XStore\bootstrap;

    require_once __DIR__ . "/../Common/Links.php";
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


</head>

<body>
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
                        <h2>Checkout<span>.</span></h2>
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
                <h3>Your Information</h3>

                <select id="addressDropdown" onchange="handleAddressChange()" class="form-control">
                    <?php
                    $address_user = Views::getAddressByUserId($bus->getUow(), (int) CURRENT_USER_ID);
                    foreach ($address_user as $address) {
                        $fullname = $address['first_name'] . ' ' . $address['last_name'];
                        $phone = $address['phone_number'];
                        $location = $address['address'];
                        error_log(json_encode($fullname), LOG_INFO);
                        echo '<option value="' . $address['id'] . '">' . $fullname . ', ' . $phone . ', ' . $location . '</option>';
                    }

                    ?>
                    <option value="Another Address">Another Address</option>
                </select>

            </div>
            <form id="popupFormContainer" class="checkout-form w-100">
                <div class="row">
                    <div id="popupForm" class="container" style="display: none; margin-top: 20px;">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">Name*</p>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" placeholder="First Name">
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">Country*</p>
                                </div>
                                <div class="col-lg-5">
                                    <select class="cart-select country-usa form-control">
                                        <option>Viet Nam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">City*</p>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">Street Address*</p>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">Email</p>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">Phone*</p>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-12">
                                    <button type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                function handleAddressChange() {
                    var dropdown = document.getElementById('addressDropdown');
                    var popupForm = document.getElementById('popupForm');
                    if (dropdown.value === 'Another Address') {
                        popupForm.style.display = 'block';
                    } else {
                        popupForm.style.display = 'none';
                    }
                }

                window.addEventListener('DOMContentLoaded', () => {

                    const popupFormContainer = document.getElementById('popupFormContainer')
                    const popupForm = document.getElementById('popupForm')

                    popupFormContainer.addEventListener('submit', (e) => {
                        e.preventDefault();

                        popupForm.style.display = 'none';

                        var first_name = popupForm.getElementsByTagName('input')[0].value;
                        var last_name = popupForm.getElementsByTagName('input')[1].value;
                        var city = popupForm.getElementsByTagName('input')[2].value;
                        var street_address = popupForm.getElementsByTagName('input')[3].value;
                        var email = popupForm.getElementsByTagName('input')[4].value;
                        var phone_number = popupForm.getElementsByTagName('input')[5].value;

                        var address = {
                            first_name: first_name,
                            last_name: last_name,
                            email: email,
                            phone_number: phone_number,
                            address: street_address + ', ' + city,
                            default_address: true
                        }


                        console.log(address);
                        fetch('/api/address', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': 'Bearer ' + localStorage.getItem('accessToken') || ''

                            },
                            body: JSON.stringify(address),
                        })
                            .then(
                                response => response.json()
                            )
                            .then(data => {
                                // var dropdown = document.getElementById('addressDropdown');
                                // var option = document.createElement("option");
                                // option.text = data.first_name + ' ' + data.last_name + ', ' + data.phone_number + ', ' + data.address;
                                // option.value = data.id;
                                // dropdown.add(option);
                                // dropdown.value = data.id;
                                window.location.reload();
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    })
                })

                // function saveAddress() {
                //     var popupForm = document.getElementById('popupForm');
                //     console.log(popupForm);

                // }
            </script>
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
                            $product_in_cart = Views::getCartProductByUserId($bus->getUow(), (int) CURRENT_USER_ID);
                            $product_dict = [];
                            foreach ($product_in_cart as $cart_product) {
                                $property_id = $cart_product["property_id"];
                                $product_dict[$property_id] = $cart_product;
                            }
                            $property_id_select = isset($_GET['product_is_select']) ? explode(',', $_GET['product_is_select']) : [];
                            $sum_total_cart = 0;

                            $products = [];
                            for ($index = 0; $index < sizeof($property_id_select ?? []); $index++) {
                                $property_id = $property_id_select[$index];
                                /**
                                 * @var Property $property
                                 */
                                $property = $repo->get(Property::class, array("id" => $property_id));
                                ;
                                $product = $product_dict[$property_id];
                                array_push($products, $product);
                                error_log(json_encode($products), LOG_INFO);

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
                                <td class="product-col">
                                    <img src="' . ($property->getPath() ?? $property->getProduct()->getPath()) . '" alt=""/>
                                    <div class="p-title">
                                        <h5>' . ($property->getProduct()->getName() ?? "") . '</h5>
                                    </div>
                                </td>
                                <td class="table-space"><strong style="font-size: 18px;">' . ($property->getPrice()) . '</strong></td>
                                <td class="quantity-col table-space">
                                    <div class="pro-qty">
                                        <input type="text" value=' . ($product["number"]) . ' disabled>
                                        </div>
                                </td>
                                <td class="table-space"><i class="fa-solid fa-circle" style="color: ' . $property->getColor() . ';"></i></td>
                                <td class="table-space">' . $size . '</td>
                                
                                <td class="table-space"><strong style="font-size: 18px;">' . ($property->getPrice()) * ($product['number']) . '</strong></td>
                            </tr>';
                            }

                            ?>
                            <tr>
                                <td class="product-col">
                                    <img src="./assets/img/icons/ship.jpg" alt="">

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
                <script>
                    var products = <?php echo json_encode($products); ?>; // Assuming $products is an array in PHP

                    // Convert the PHP array to a JavaScript array and store it in localStorage
                    localStorage.setItem('products', JSON.stringify(products));
                </script>
                <!-- <div class="cart-btn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="coupon-input">
                            <input type="text" placeholder="Enter cupone code">
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 text-left text-lg-right">
                        <div class="site-btn clear-btn">Clear Cart</div>
                        <div class="site-btn update-btn">Purchase</div>
                    </div>
                </div>
            </div> -->
            </div>
            <div class="shopping-method">
                <div class="container">
                    <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="shipping-info">
                            <h5>Choose a shipping</h5>
                            <div class="chose-shipping">
                                <div class="cs-item">
                                    <input type="radio" name="cs" id="one">
                                    <label for="one" class="active">
                                        Free Standard shhipping
                                        <span>Estimate for New York</span>
                                    </label>
                                </div>
                                <div class="cs-item">
                                    <input type="radio" name="cs" id="two">
                                    <label for="two">
                                        Next Day delievery $10
                                    </label>
                                </div>
                                <div class="cs-item last">
                                    <input type="radio" name="cs" id="three">
                                    <label for="three">
                                        In Store Pickup - Free
                                    </label>
                                </div>
                            </div>
                        </div> -->
                    <div class="total-info">
                        <div class="total-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td class="total-cart">Total</td>
                                    </tr>

                                    <tr>
                                        <?php
                                        echo '<td class="total-cart">' . $sum_total_cart + 25000 . '</td>'
                                            ?>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button id="btn-purchase" class="primary-btn chechout-btn">Purchase</button>
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
        window.addEventListener('DOMContentLoaded', () => {
            document.getElementById('btn-purchase').addEventListener('click', () => {
                var addressId = $('#addressDropdown').val();
                var products = localStorage.getItem('products')

                fetch('/api/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken') || ''
                    },
                    body: JSON.stringify(
                        {
                            address_id: Number(addressId),
                            products: JSON.parse(products)
                        }
                    ),
                }).then(
                    response => response.json()
                )
                    .then(data => {
                        console.log(data)
                        window.location.href = '/orders';
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });

                console.log(products, addressId)
            })
        })
    </script>

</body>

</html>