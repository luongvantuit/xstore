<!DOCTYPE html>
<html lang="en">

</head>
    <title>Home - XStore</title>
</head>

<body>
    <?php
    require_once __DIR__ . "/../Common/Header.php";
    use XStore\Services\ProductService;

    $products = new ProductService();

    $products = $products->getProducts();
    $product = $products[1];
    ?>
    <section class="features-section spad">
        <div class="features-ads">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-features-ads first">
                            <img src="./assets/img/icons/f-delivery.png" alt="">
                            <h4>Miẽn ship</h4>
                            <p>Miễn ship cho các đơn hàng từ 1000000 đồng trở lên</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-features-ads second">
                            <img src="./assets/img/icons/coin.png" alt="">
                            <h4>Chính sách hoàn tiền 100% </h4>
                            <p>Đối với các phát hiện bị lỗi đến từ sản phẩm. </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-features-ads">
                            <img src="./assets/img/icons/chat.png" alt="">
                            <h4>Hỗ trợ tư vấn 24/7</h4>
                            <p>Với đội ngũ chuyên viên thời trang luôn sẵn sàng tư vấn bất cưs lúc nào</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features Box -->
        <div class="features-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="single-box-item first-box">
                                    <a href="http://localhost:3000/product-detail?id=<?php echo $product->getID() ?>"><img src="<?php echo $product->getPath() ?>" alt=""></a>
                                    <div class="box-text">
                                        <span class="trend-year">2023 Unisex</span>
                                        <h2>Jewelry</h2>
                                        <span class="trend-alert">Trend Allert</span>
                                        <a href="#" class="primary-btn">See More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="single-box-item second-box">
                                    <img src="./assets/img/f-box-2.jpg" alt="">
                                    <div class="box-text">
                                        <span class="trend-year">2023 Trend</span>
                                        <h2></h2>
                                        <span class="trend-alert">Bold & Black</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="single-box-item large-box">
                            <img src="./assets/img/f-box-3.jpg" alt="">
                            <div class="box-text">
                                <span class="trend-year">2023 Party</span>
                                <h2>Collection</h2>
                                <div class="trend-alert">Trend Allert</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Section End -->

    <!-- Latest Product Begin -->
    <section class="latest-products spad">
        <div class="container">
            <div class="product-filter">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Latest Products</h2>
                        </div>
                        <ul class="product-controls">
                            <li data-filter="*">All</li>
                            <li data-filter=".dresses">Dresses</li>
                            <li data-filter=".bags">Bags</li>
                            <li data-filter=".shoes">Shoes</li>
                            <li data-filter=".accesories">Accesories</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-product-item">
                            <figure>
                                <a href="http://localhost:3000/product-detail?id=<?php echo $product->getID() ?>">
                                    <img src="<?php echo $product->getPath() ?>" alt="">
                                </a>
                                <div class="p-status"><?php echo $product->getName() ?></div>
                            </figure>
                            <div class="product-text">
                                <h6><?php echo $product->getDescription() ?></h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Latest Product End -->


    <!-- Logo Section Begin -->

    <?php
    require_once __DIR__ . "/../Common/Footer.php"
    ?>
</body>

</html>