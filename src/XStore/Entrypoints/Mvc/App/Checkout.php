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
    require_once __DIR__ . "/../Common/Links.php";
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
                <div class="col-lg-8">
                    <img src="img/add.jpg" alt="">
                </div>
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
                    <option value="1">Thuy Dung, +84123456789, 334 Nguyen Trai, Thanh Xuan, Ha Noi, Viet Nam</option>
                    <option value="2">A, +84123456789, 334 Nguyen Trai, Thanh Xuan, Ha Noi, Viet Nam</option>
                    <option value="Another Address">Another Address</option>
                </select>

            </div>
            <form action="#" class="checkout-form w-100">
                <div class="row">
                    <div id="popupForm" style="display: none; margin-top: 20px;">
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
                                <div class="col-lg-10">
                                    <select class="cart-select country-usa form-control">
                                        <option>Viet Nam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">City*</p>
                                </div>
                                <div class="col-lg-10">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">Street Address*</p>
                                </div>
                                <div class="col-lg-10">
                                    <input type="text">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">Email</p>
                                </div>
                                <div class="col-lg-10">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <p class="in-name">Phone*</p>
                                </div>
                                <div class="col-lg-10">
                                    <input type="text">
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-12">
                                    <button onclick="saveAddress()">Save</button>
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

                function saveAddress() {
                    var popupForm = document.getElementById('popupForm');
                    popupForm.style.display = 'none';
                }
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
                            <tr>
                                <td class="product-col">
                                    <img src="./assets/img/product/product-1.jpg" alt="">

                                    <div class="p-title">
                                        <h5>Blue Dotted Shirt</h5>
                                    </div>
                                </td>
                                <td class="price-col">99000</td>
                                <td class="quantity-col">
                                    <div class="pro-qty">
                                        <input type="text" value=1>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="product-col">
                                    <img src="./assets/img/products/img-1.jpg" alt="">

                                    <div class="p-title">
                                        <h5>Blue Dotted Shirt</h5>
                                    </div>
                                </td>
                                <td class="price-col">99000</td>
                                <td class="quantity-col">
                                    <div class="pro-qty">
                                        <input type="text" value=1>
                                    </div>
                                </td>
                            </tr>
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
                                        <td class="total-cart">198000</td>
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