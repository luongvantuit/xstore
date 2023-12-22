<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XStore - Product</title>
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
    use XStore\Domains\Models\Product;
    use XStore\Domains\Models\Property;

    use function XStore\bootstrap;

    require_once __DIR__ . "/../../../Bootstrap.php";

    $bus = bootstrap();
    /**
     * @var DoctrineUnitOfWork $uow
     */
    $uow = $bus->getUow();
    $repo = $uow->getRepository();
    $currentUser = null;
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
        } catch (Exception $e) {
            error_log($e, LOG_INFO);
        }
    }
    $currentProduct = null;
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        http_response_code(302);
        header("Location: /products");
        exit;
    } else {
        /**
         * @var Product $currentProduct
         */
        $currentProduct = $repo->get(Product::class, array("id" => (int) $_GET["id"]));
        if ($currentProduct == null) {
            http_response_code(302);
            header("Location: /products");
            exit;
        }
    }
    $sizeId = 0;
    if (isset($_GET["size_id"]) && is_numeric($_GET["size_id"])) {
        $sizeId = (int) $_GET["size_id"];
        if ($sizeId > 3) {
            $sizeId = 0;
        }
    }
    ?>
    <div class="modal fade" id="goToCartModal" tabindex="-1" aria-labelledby="goToCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="goToCartModalLabel">Go to Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Congratulations on having another successful product
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No/Close</button>
                    <a href="/cart" class="btn btn-success">Yes/Redirect</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                <?php

                $propertiesBySizeIds = $repo->getAll(Property::class, array("sizeId" => $sizeId));
                $propertyId = null;
                $propertyGlobal = null;
                if (sizeof($propertiesBySizeIds) > 0) {
                    $propertyId = $propertiesBySizeIds[0]->getId();
                    $propertyGlobal = $propertiesBySizeIds[0];
                    if (isset($_GET["property_id"]) && is_numeric($_GET["property_id"])) {
                        foreach ($propertiesBySizeIds as $property) {
                            if ($property->getId() == (int) $_GET["property_id"]) {
                                $propertyId = (int) $_GET["property_id"];
                                $propertyGlobal = $property;
                            }
                        }
                    }
                }
                echo '<img src="' . ($propertyGlobal == null || $propertyGlobal->getPath() == null ? $currentProduct->getPath() : $propertyGlobal->getPath()) . '" alt="" srcset="">'
                    ?>
            </div>
            <div class="col d-none d-lg-block">
                <?php
                echo '<strong class="h4">' . ($currentProduct->getName()) . '</strong>';

                ?>
                <div class="mt-2">Color</div>
                <div class="d-flex flex-row mt-1" style="gap: 4px;">

                    <?php
                    if (sizeof($propertiesBySizeIds) == 0) {
                        echo '<a href="#" class="btn btn-outline-dark"><i class="fa-solid fa-xmark"></i></a>';
                    } else {
                        foreach ($propertiesBySizeIds as $property) {
                            echo '<a href="/product?id=' . ($_GET["id"]) . '&size_id=' . ($sizeId) . '&property_id=' . ($property->getId()) . '" class="btn ' . ($property->getId() == $propertyId ? "rounded-circle" : "") . '" style="background-color:' . ($property->getColor()) . ';"><i class="fa-solid fa-xmark" style="color: transparent;"></i></a>';
                        }
                    }
                    ?>
                </div>
                <div class="mt-2">Size</div>
                <div class="d-flex flex-row mt-1" style="gap: 4px;">
                    <?php

                    foreach (range(0, 3) as $sId) {
                        $size = 'Free Size';
                        switch ($sId) {
                            case 1:
                                $size = "M";
                                break;
                            case 2:
                                $size = "L";
                                break;
                            case 3:
                                $size = "XL";
                                break;
                            default:
                                $size = 'Free Size';
                                break;
                        }
                        echo '<a href="/product?id=' . ($_GET["id"]) . '&size_id=' . ($sId) . '" class="btn ' . ($sId == $sizeId ? "btn-dark" : "") . '">' . ($size) . '</a>';
                    }
                    ?>
                </div>
                <?php
                echo '<div class="mt-2"">Quantity <strong>' . ($propertyGlobal == null ? "0" : $propertyGlobal->getNumber()) . '</strong></div>'
                    ?>
                <!-- <button class=" btn btn-outline-dark w-100 py-2 mt-2">Buy Now</button> -->
                <?php
                if ($currentUser == null) {
                    echo '<button class="btn btn-dark w-100 py-2 mt-2" onclick="goToLogin()">Add To Cart</button>';
                } else {
                    if ($propertyGlobal != null && $propertyGlobal->getNumber() > 0) {
                        echo '<button class="btn btn-dark w-100 py-2 mt-2" onclick="addToCart(' . ($propertyGlobal->getId()) . ')">Add To Cart</button>';
                    } else {
                        echo '<button class="btn btn-dark w-100 py-2 mt-2">Add To Cart</button>';
                    }
                }
                ?>
                <nav class="mt-2">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-item nav-link active" id="nav-description-tab" data-toggle="tab"
                            href="#nav-description" role="tab" aria-controls="nav-home"
                            aria-selected="true">Description</button>
                    </div>
                </nav>
                <div class="tab-content mt-2" id="nav-tabContent">
                    <?php
                    echo '<div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">' . ($currentProduct->getDescription()) . '</div>'
                        ?>

                </div>

            </div>
        </div>
        <div class="row d-lg-none d-block">
            <div class="col">
                <?php
                echo '<strong class="h4">' . ($currentProduct->getName()) . '</strong>'
                    ?>
                <button class="btn btn-outline-dark w-100 py-2 mt-2">Buy Now</button>
                ?>
                <nav class="mt-2">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-item nav-link active" id="nav-description-tab" data-toggle="tab"
                            href="#nav-description" role="tab" aria-controls="nav-home"
                            aria-selected="true">Description</button>
                    </div>
                </nav>
                <div class="tab-content mt-2" id="nav-tabContent">
                    <?php
                    echo '<div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">' . ($currentProduct->getDescription()) . '</div>'
                        ?>

                </div>

            </div>
        </div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toast-notify-failed" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="/assets/admin/svgs/solid/layer-group.svg" class="rounded me-2" style="width: 24px;" alt="...">
                <strong class="me-auto">XStore</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="toast-notify-failed-message" class="toast-body">

            </div>
        </div>
    </div>
    <?php
    require_once __DIR__ . "/../Common/Footer.php";
    require_once __DIR__ . "/../Common/Scripts.php";
    ?>
    <script src="/assets/app/js/product.js"></script>
</body>

</html>