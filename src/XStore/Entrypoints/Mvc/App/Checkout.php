<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Violet | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/style.css" type="text/css">
</head>
<?php
    require_once __DIR__ . "/../Common/Header.php";
    ?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
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
            <form action="#" class="checkout-form">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Your Information</h3>
                    </div>

                    <div class="col-lg-9">
                    <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Address:</p>
                            </div>
                            <div class="col-lg-10" style="white-space: pre-line;">
                                <p type="text">Thuy Dung 
                                +84123456789 
                                334 Nguyen Trai, Thanh Xuan, Ha Noi, Viet Nam</p>
                            </div>
                            <select id="addressDropdown">
                                <option value="334 Nguyen Trai, Thanh Xuan, Ha Noi, Viet Nam">334 Nguyen Trai, Thanh Xuan, Ha Noi, Viet Nam</option>
                                <option value="New Address">New Address</option>
                                <!-- Thêm các tùy chọn địa chỉ khác ở đây -->
                            </select>
                            </div>
                        </div>
                    </div>

                    
<div id="popupForm" style="display: none;">
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
                <select class="cart-select country-usa">
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
    </div>
</div>

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
</script>
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
                                <select class="cart-select country-usa">
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
                        <!-- <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Post Code/ZIP*</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text">
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="in-name">Phone*</p>
                            </div>
                            <div class="col-lg-10">
                                <input type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <div class="diff-addr">
                                    <input type="radio" id="one">
                                    <label for="one">Ship to different address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="order-table">
                            <div class="cart-item">
                                <span>Product</span>
                                <p class="product-name">Blue Dotted Shirt</p>
                                <p class="product-name">Blue Dotted Shirt</p>

                            </div>
                            <div class="cart-item">
                                <span>Price</span>
                                <p>$29</p>
                            </div>
                            <div class="cart-item">
                                <span>Quantity</span>
                                <p>1</p>
                            </div>
                            <div class="cart-item">
                                <span>Shipping</span>
                                <p>$10</p>
                            </div>

                            <div class="cart-total">
                                <span>Total</span>
                                <p>$39</p>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="cart-page">
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
            </div>
        </div>
    </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-method">
                            <h3>Payment</h3>
                            <ul>
                                <!-- <li>Paypal <img src="./assets/img/paypal.jpg" alt=""></li> -->
                                <li>Credit / Debit card <img src="./assets/img/mastercard.jpg" alt=""></li>
                                <li>
                                    <label for="two">Pay when you get the package</label>
                                    <input type="radio" id="two">
                                </li>
                            </ul>
                            <button type="submit">Place your order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Cart Total Page End -->
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>