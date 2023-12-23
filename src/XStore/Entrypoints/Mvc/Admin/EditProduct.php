<?php

use XStore\Configs;
use XStore\Domains\Models\Admin;
use XStore\Domains\Models\Product;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\Views;
use XStore\X\Jw\Jwt;

use function XStore\bootstrap;

require_once __DIR__ . "/../../../Bootstrap.php";

$bus = bootstrap();
/**
 * @var DoctrineUnitOfWork $uow
 */
$uow = $bus->getUow();
$repo = $uow->getRepository();

/**
 * @var Admin $model
 */
$model = $repo->get(Admin::class, array("username" => "root"));
if ($model == null) {
    http_response_code(302);
    header("Location: /admin/initial-root-password");
    exit;
}

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    http_response_code(302);
    header("Location: /admin/products");
    exit;
} else {
    /**
     * @var Product $product
     */
    $product = $repo->get(Product::class, array("id" => (int) $_GET["id"]));
    if ($product == null) {
        http_response_code(302);
        header("Location: /admin/products");
        exit;
    }
}

if (isset($_COOKIE["adminAccessToken"])) {
    /**
     * @var string $accessToken
     */
    $accessToken = $_COOKIE["adminAccessToken"];
    try {
        $payload = (new Jwt("admin" . Configs::getSecretKey()))->decode($accessToken);
        $adminId = (int) $payload["id"];
        /**
         * @var Admin $currentAdmin
         */
        $currentAdmin = $repo->get(Admin::class, array("id" => $adminId));
        if ($currentAdmin == null) {
            http_response_code(302);
            header("Location: /admin/login");
            exit;
        }
    } catch (\Exception $e) {
        error_log($e, LOG_INFO);
        http_response_code(302);
        header("Location: /admin/login");
        exit;
    }
} else {
    http_response_code(302);
    header("Location: /admin/login");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/home.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/left-navbar.css" type="text/css">
</head>

<body id="body-pd" class="bg-light">
    <header class="xstore-header" id="header">
        <div class="xstore-header-toggle" id="header-toggle"> <i class='fa-solid fa-bars'></i></div>
        <div class="xstore-header-img"> <img
                src="https://gravatar.com/avatar/9942e2bf3f700a029b748508b1043c43?d=identicon" alt=""> </div>
    </header>
    <div class="xstore-l-navbar" id="nav-bar">
        <nav class="xstore-nav">
            <div>
                <a href="/" class="xstore-nav-logo">
                    <i class='fa-solid fa-layer-group xstore-nav-logo-icon'></i> <span
                        class="xstore-nav-logo-name">XStore</span>
                </a>
                <div class="xstore-nav-list">
                    <a href="/admin" class="xstore-nav-link xstore-active">
                        <i class="fa-solid fa-gauge xstore-nav-icon"></i> <span class="xstore-nav-name">Dashboard</span>
                    </a>
                    <a href="/admin/users" class="xstore-nav-link">
                        <i class="fa-solid fa-user xstore-nav-icon"></i> <span class="xstore-nav-name">Users</span>
                    </a>
                    <a href="/admin/products" class="xstore-nav-link">
                        <i class='fa-solid fa-store xstore-nav-icon'></i> <span class="xstore-nav-name">Products</span>
                    </a>
                    <a href="/admin/orders" class="xstore-nav-link">
                        <i class="fa-solid fa-box-open xstore-nav-icon"></i> <span class="xstore-nav-name">Orders</span>
                    </a>
                    <a href="/admin/admins" class="xstore-nav-link">
                        <i class="fa-solid fa-shield-halved xstore-nav-icon"></i> <span
                            class="xstore-nav-name">Admins</span>
                    </a>
                </div>
            </div>
            <div class="xstore-nav-link" data-bs-toggle="modal" data-bs-target="#signOutModal">
                <i class='fa-solid fa-door-open xstore-nav-icon'></i> <span class="xstore-nav-name">SignOut</span>
            </div>
        </nav>
    </div>
    <!-- Modal SigOut -->
    <div class="modal fade" id="signOutModal" tabindex="-1" aria-labelledby="signOutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signOutModalLabel">Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No/Close</button>
                    <button type="button" class="btn btn-danger" id="btn-sign-out">Yes/SignOut</button>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light">
        <form id="form-edit-product" class="d-flex flex-column justify-content-center gap-3 needs-validation"
            novalidate>
            <div id="form-edit-product-alert" class="alert alert-danger alert-dismissible fade show d-none"
                role="alert">
                <strong>Error!</strong>
                <p id="form-edit-alert-message">You should check in on some of those
                    fields below.</p>
            </div>
            <div class="form-group">
                <label for="input-name">Name</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">
                        <i class="fa-solid fa-signature"></i>
                    </span>
                    <input type="text" class="form-control" id="input-name" name="name" placeholder="name" required
                        value="<?php echo $product->getName() ?>">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div id="input-name-invalid-feedback-message" class="invalid-feedback">
                        Please enter a name of product!
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="input-description">Description</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">
                        <i class="fa-solid fa-mortar-pestle"></i>
                    </span>
                    <input type="text" class="form-control" id="input-description" name="description"
                        placeholder="description" value="<?php echo $product->getDescription() ?> ">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div id="input-description-invalid-feedback-message" class="invalid-feedback">
                        <!-- Invalid message -->
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="input-photo">Photo</label>
                <div class="d-flex justify-content-center align-items-center my-2">

                    <img src="<?php echo $product->getPath() ?>" alt="" srcset="" class="w-25">
                </div>
                <div class="input-group has-validation">

                    <span class="input-group-text">
                        <i class="fa-solid fa-file"></i>
                    </span>
                    <input type="file" class="form-control" id="input-photo" placeholder="photo" name="file"
                        accept="image/png, image/jpeg" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div id="input-photo-invalid-feedback-message" class="invalid-feedback">
                        Require a photo!
                    </div>
                </div>
            </div>
            <button id="btn-form-edit-product" type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="modal fade" id="addPropertyModal" tabindex="0" aria-labelledby="addPropertyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPropertyModalLabel">Add New A Property</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form id="form-add-property"
                                class="d-flex flex-column justify-content-center gap-3 needs-validation" novalidate>
                                <div id="form-add-property-alert"
                                    class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                    <strong>Error!</strong>
                                    <p id="form-add-property-alert-message">You should check in on some of those
                                        fields below.</p>
                                </div>
                                <div class="form-group">
                                    <label for="input-color">Color</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-droplet"></i>
                                        </span>
                                        <input type="color" class="form-control" id="input-color" placeholder="color"
                                            required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div id="input-color-invalid-feedback-message" class="invalid-feedback">
                                            Require a color property!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-number">Number</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-arrow-up-9-1"></i>
                                        </span>
                                        <input type="number" step="1" class="form-control" id="input-number"
                                            placeholder="number" min="1" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div id="input-number-invalid-feedback-message" class="invalid-feedback">
                                            Please enter a number > 1!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-size-id">Size ID</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-hat-cowboy-side"></i>
                                        </span>
                                        <select id="input-size-id" class="form-select" aria-label="Size ID" required>
                                            <option value="0" selected>Free Size</option>
                                            <option value="1">M</option>
                                            <option value="2">L</option>
                                            <option value="3">XL</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div id="input-size-id-invalid-feedback-message" class="invalid-feedback">
                                            <!-- Invalid message -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-price">Price</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-ghost"></i>
                                        </span>
                                        <input type="number" class="form-control" id="input-price" placeholder="number"
                                            min="0" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div id="input-price-invalid-feedback-message" class="invalid-feedback">
                                            Require enter a price of >= 0!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-photo-add-property">Photo</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-file"></i>
                                        </span>
                                        <input type="file" class="form-control" id="input-photo-add-property"
                                            placeholder="photo" name="file" accept="image/png, image/jpeg">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div id="input-photo-invalid-feedback-message" class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <button id="btn-form-add-property" type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancel/Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addPropertyModal">Add
            Property</button>
        <?php
        // *
        $currentPage = $_GET["page"] ?? 0;
        if ($currentPage < 0) {
            $currentPage = 0;
        }
        $limit = $_GET["limit"] ?? 10;
        if ($limit == 0) {
            $limit = 10;
        }
        $properties = Views::getProperties($bus->getUow(), (int) $_GET["id"], limit: $limit, offset: $limit * $currentPage);
        ?>
        <table class="table table-striped table-bordered mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Size ID</th>
                    <th>Photo</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($index = 0; $index < sizeof($properties ?? []); $index++) {
                    $size = 'Free Size';
                    switch ($properties[$index]["size_id"]) {
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
                    echo '
                    <tr>
                            <td>
                                ' . $index . '
                            </td>
                        <td><i class="fa-solid fa-circle" style="color: ' . $properties[$index]["color"] . ';"></i></td>
                        <td>' . $properties[$index]["number"] . '</td>
                        <td>' . $properties[$index]["price"] . '</td>
                        <td>' . $size . '</td>
                        <div class="modal fade" id="photoPropertyModal' . $properties[$index]["id"] . '" tabindex="-1" aria-labelledby="photoPropertyModalLabel' . $properties[$index]["id"] . '" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="photoPropertyModalLabel' . $properties[$index]["id"] . '">Photo Of Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="' . $properties[$index]["path"] . '" class="rounded mx-auto d-block w-75 h-75"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No/Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td>' . ($properties[$index]["path"] != null ? '<a class="btn text-primary" href="#photoPropertyModal' . $properties[$index]["id"] . '" data-bs-toggle="modal"><i class="fa-solid fa-image"></i></a>' : '') . '</td>
                        <td>' . $properties[$index]["created_at"] . '</td>
                        <td>' . $properties[$index]["updated_at"] . '</td>
                        <td>
                            <div class="modal fade" id="deletePropertyModal' . $properties[$index]["id"] . '" tabindex="-1" aria-labelledby="deletePropertyModalLabel' . $properties[$index]["id"] . '" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deletePropertyModalLabel' . $properties[$index]["id"] . '">Are you sure?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No/Close</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteProperty(' . $properties[$index]["id"] . ')">Yes/Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton' . $properties[$index]["id"] . '" data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $properties[$index]["id"] . '">
                                    <li><a class="dropdown-item text-danger" href="#deletePropertyModal' . $properties[$index]["id"] . '" data-bs-toggle="modal">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>

        <?php
        // * Pagination
        $sizeOfProperties = Views::getSizeOfProperties($bus->getUow(), (int) $_GET["id"]);
        $pageNumbers = ceil($sizeOfProperties / $limit);
        $minRangePage = max(0, $currentPage - 2);
        $maxRangePage = min($pageNumbers - 1, $currentPage + 2);
        if ($pageNumbers == 0) {
            $maxRangePage = 0;
        }
        ?>
        <nav aria-label="Properties navigation">
            <ul class="pagination">
                <?php
                echo '
                <li class="page-item">
                    <a class="page-link ' . ($currentPage > 0 ? "" : "btn disabled") . '" href="/admin/product/edit?id=' . $_GET["id"] . '&page=' . ($currentPage - 1) . '" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                ';
                if ($currentPage >= 3) {
                    echo '<li class="page-item"><a class="page-link" href="/admin/product/edit?id=' . $_GET["id"] . '&page=' . ($currentPage - 3) . '">...</a></li>';
                }
                foreach (range($minRangePage, $maxRangePage) as $pageNumber) {
                    echo '<li class="page-item"><a class="page-link" href="/admin/product/edit?id=' . $_GET["id"] . '&page=' . $pageNumber . '">' . $pageNumber . '</a></li>';
                }
                if ($currentPage < $pageNumbers - 3) {
                    echo ' <li class="page-item"><a class="page-link" href="/admin/product/edit?id=' . $_GET["id"] . '&page=' . ($currentPage + 3) . '">...</a></li>';
                }
                echo '
                <li class="page-item">
                    <a class="page-link ' . ($currentPage < $pageNumbers - 1 ? "" : "btn disabled") . '" href="/admin/product/edit?id=' . $_GET["id"] . '&page=' . ($currentPage + 1) . '" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                '
                    ?>
            </ul>
        </nav>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast-notify-failed" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="/assets/admin/svgs/solid/layer-group.svg" class="rounded me-2" style="width: 24px;"
                        alt="...">
                    <strong class="me-auto">XStore</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div id="toast-notify-failed-message" class="toast-body">

                </div>
            </div>
        </div>
    </div>
    <script src="/assets/admin/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/admin/js/left-navbar.js"></script>
    <script src="/assets/admin/js/edit-product.js"></script>
</body>

</html>