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
    $products = Views::getProductsAgent($bus->getUow(), limit: $limit, offset: $limit * $currentPage);
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
                                $properties = Views::getProperties($bus->getUow(), (int) $product["id"]);
                                if ($properties != null && sizeof($properties) > 0) {
                                    echo '<p>' . $properties[0]["price"] . '</p>';
                                } else {
                                    echo "<p>Out stock</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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