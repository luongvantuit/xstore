<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <?php
    require_once __DIR__ . "/../Common/Header.php";

    //    echo phpinfo();
    use XStore\Services\ProductService;

    $products = new ProductService();

    $products = $products->getProducts();

    ?>
    <section class="related-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($products as $product) : ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-product-item">
                            <figure>
                                <a href="http://localhost:3000/product-detail?id=<?php echo $product->getID() ?>">
                                    <img src="<?php echo $product->getPath() ?>" alt="">
                                </a>

                            </figure>
                            <div class="product-text">
                                <h6><?php echo $product->getName() ?></h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    require_once __DIR__ . "/../Common/Footer.php"
    ?>
</body>

</html>