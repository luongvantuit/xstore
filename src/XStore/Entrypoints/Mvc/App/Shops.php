<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script> src = "/assets/app/js/cart.js"</script>
    
</head>

<body>
<?php
    require_once __DIR__ . "/../Common/Header.php"
?>

<!-- <section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Cart<span>.</span></h2>
                        <a href="#">Trang chủ</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="./assets/img/add.jpg" alt="">
                </div>
            </div>
        </div>
    </section> -->

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
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="product-select">
                                <label>
                                    <input type="checkbox">
                                    <span></span>
                                </label>
                            </td>
                            <td class="product-col">
        
                                <img src="./assets/img/product/product-1.jpg" alt="">
                      
                                <div class="p-title">
                                    <h5>Blue Dotted Shirt</h5>
                                </div>
                            </td>
                            <td class="price-col">99000</td>
                            <td class="quantity-col">
                                <div class="pro-qty">
                                <span class="minus" style="font-size: 24px;">-</span>
                                <input type="text" value=1>
                                <span class="plus" style="font-size: 24px;">+</span>
                                </div>
                            </td>
                            <td class="total">99000</td>
                            <td class="product-close">x</td>
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
                                        <td class="total-cart">Total Cart</td>
                                    </tr>
                 
                                    <tr>
                                        <td class="total-cart">99000</td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <a href="#" class="primary-btn chechout-btn">Purchase</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>