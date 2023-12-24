<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XStore - Products</title>
    <?php
    require_once __DIR__ . "/../Common/Links.php";
    ?>
</head>

<body>
    <?php
    require_once __DIR__ . "/../Common/Header.php";
    ?>
    <?php

    use XStore\Views;
    use function XStore\bootstrap;

    require_once __DIR__ . "/../../../Bootstrap.php";
    $bus = bootstrap();
    /**
     * @var DoctrineUnitOfWork $uow
     */
    $uow = $bus->getUow();
    $repo = $uow->getRepository();
    // *
    $currentPage = $_GET["page"] ?? 0;
    if ($currentPage < 0) {
        $currentPage = 0;
    }
    $limit = -1;
    $products = Views::getProductsAgent($bus->getUow(), limit: $limit, offset: $limit * $currentPage) ?? [];
    $product_in_stock = array();
    $product_out_stock = array();
    foreach ($products as $product) {

        $properties = Views::getProperties($bus->getUow(), (int) $product["id"]);
        if ($properties != null && sizeof($properties) > 0) {
            $product["price"] = $properties[0]["price"];
            array_push($product_in_stock, $product);
        } else {
            $product["price"] = "Out stock";
            array_push($product_out_stock, $product);
        }
    }
    $products = [];
    // error_log($product_in_stock[0]->getName(), LOG_INFO);
    array_push($products, ...$product_in_stock);
    array_push($products, ...$product_out_stock);
    // echo json_encode($product_in_stock);
    
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
                <?php if (sizeof($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="single-product-item p-3">
                                <figure>
                                    <a href="/product?id=<?php echo $product["id"] ?>">
                                        <img src="<?php echo $product["path"] ?>" alt="" />
                                    </a>

                                </figure>
                                <div class="product-text">
                                    <h6>
                                        <?php echo $product["name"] ?>
                                    </h6>
                                    <?php
                                    echo '<p>' . $product["price"] . '</p>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="w-100 d-flex flex-column justify-content-center align-items-center mt-5">
                        <img src="/assets/img/svgs/undraw_not_found.svg" alt="" class="w-50">
                        <p class="h3 my-3">
                            Sorry! Not found product!
                        </p>
                        <a href="/" class="btn btn-dark">Go Back Home</a>
                    </div>
                <?php endif ?>
            </div>
        </div>
        </div>
    </section>
    <?php
    require_once __DIR__ . "/../Common/Footer.php";
    require_once __DIR__ . "/../Common/Scripts.php";
    ?>
</body>

</html>