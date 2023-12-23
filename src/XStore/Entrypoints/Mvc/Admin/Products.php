<?php

use XStore\Configs;
use XStore\Domains\Models\Admin;
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
    <title>Products</title>
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/fontawesome.min.css" type="text/css">
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
                    <a href="/admin" class="xstore-nav-link">
                        <i class="fa-solid fa-gauge xstore-nav-icon"></i> <span class="xstore-nav-name">Dashboard</span>
                    </a>
                    <a href="/admin/users" class="xstore-nav-link">
                        <i class="fa-solid fa-user xstore-nav-icon"></i> <span class="xstore-nav-name">Users</span>
                    </a>
                    <a href="/admin/products" class="xstore-nav-link xstore-active">
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
        <div class="modal fade" id="addProductModal" tabindex="0" aria-labelledby="addProductModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModal">Add New A Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form id="form-add-new-a-product"
                                class="d-flex flex-column justify-content-center gap-3 needs-validation" novalidate>
                                <div id="form-add-new-a-product-alert"
                                    class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                    <strong>Error!</strong>
                                    <p id="form-add-new-a-product-alert-message">You should check in on some of those
                                        fields below.</p>
                                </div>
                                <div class="form-group">
                                    <label for="input-name">Name</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-signature"></i>
                                        </span>
                                        <input type="text" class="form-control" id="input-name" name="name"
                                            placeholder="name" required>
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
                                        <input type="text" class="form-control" id="input-description"
                                            name="description" placeholder="description">
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
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-file"></i>
                                        </span>
                                        <input type="file" class="form-control" id="input-photo" placeholder="photo"
                                            name="file" accept="image/png, image/jpeg" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div id="input-photo-invalid-feedback-message" class="invalid-feedback">
                                            Require a photo!
                                        </div>
                                    </div>
                                </div>
                                <button id="btn-form-add-new-a-product" type="submit"
                                    class="btn btn-primary">Submit</button>
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
        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addProductModal">Add
            Product</button>
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
        $products = Views::getProductsAgent($bus->getUow(), limit: $limit, offset: $limit * $currentPage);
        ?>
        <table class="table table-striped table-bordered mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($index = 0; $index < sizeof($products ?? []); $index++) {
                    echo '
                    <tr>
                        <td>
                            ' . $index . '
                        </td>
                        <td>' . $products[$index]["name"] . '</td>
                        <td>' . $products[$index]["description"] . '</td>
                        <div class="modal fade" id="photoProductModal' . $products[$index]["id"] . '" tabindex="-1" aria-labelledby="photoProductModalLabel' . $products[$index]["id"] . '" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="photoProductModalLabel' . $products[$index]["id"] . '">Photo Of Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="' . $products[$index]["path"] . '" class="rounded mx-auto d-block w-75 h-75"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No/Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td><a class="btn text-primary" href="#photoProductModal' . $products[$index]["id"] . '" data-bs-toggle="modal"><i class="fa-solid fa-image"></i></a></td>
                        <td>' . $products[$index]["created_at"] . '</td>
                        <td>' . $products[$index]["updated_at"] . '</td>
                        <td>
                            <div class="modal fade" id="deleteProductModal' . $products[$index]["id"] . '" tabindex="-1" aria-labelledby="deleteProductModalLabel' . $products[$index]["id"] . '" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteProductModalLabel' . $products[$index]["id"] . '">Are you sure?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            You want delete product <strong>' . $products[$index]["name"] . '</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No/Close</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteProduct(' . $products[$index]["id"] . ')">Yes/Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton' . $products[$index]["id"] . '" data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $products[$index]["id"] . '">
            
                                    <li><a class="dropdown-item" href="/admin/product/edit?id=' . $products[$index]["id"] . '">Edit</a></li>
                                    <li><a class="dropdown-item text-danger" href="#deleteProductModal' . $products[$index]["id"] . '" data-bs-toggle="modal">Delete</a></li>
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
        $sizeOfProducts = Views::getSizeOfProducts($bus->getUow());
        $pageNumbers = ceil($sizeOfProducts / $limit);
        $minRangePage = max(0, $currentPage - 2);
        $maxRangePage = min($pageNumbers - 1, $currentPage + 2);
        if ($pageNumbers == 0) {
            $maxRangePage = 0;
        }
        ?>
        <nav aria-label="Products navigation">
            <ul class="pagination">
                <?php
                echo '
                <li class="page-item">
                    <a class="page-link ' . ($currentPage > 0 ? "" : "btn disabled") . '" href="/admin/products/?page=' . ($currentPage - 1) . '" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                ';
                if ($currentPage >= 3) {
                    echo '<li class="page-item"><a class="page-link" href="/admin/products/?page=' . ($currentPage - 3) . '">...</a></li>';
                }
                foreach (range($minRangePage, $maxRangePage) as $pageNumber) {
                    echo '<li class="page-item"><a class="page-link" href="/admin/products/?page=' . $pageNumber . '">' . $pageNumber . '</a></li>';
                }
                if ($currentPage < $pageNumbers - 3) {
                    echo ' <li class="page-item"><a class="page-link" href="/admin/products/?page=' . ($currentPage + 3) . '">...</a></li>';
                }
                echo '
                <li class="page-item">
                    <a class="page-link ' . ($currentPage < $pageNumbers - 1 ? "" : "btn disabled") . '" href="/admin/products/?page=' . ($currentPage + 1) . '" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                '
                    ?>
            </ul>
        </nav>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast-delete-product-failed" class="toast hide" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-header">
                    <img src="/assets/admin/svgs/solid/layer-group.svg" class="rounded me-2" style="width: 24px;"
                        alt="...">
                    <strong class="me-auto">XStore</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div id="toast-delete-product-failed-message" class="toast-body">

                </div>
            </div>
        </div>

    </div>
    <script src="/assets/admin/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/admin/js/left-navbar.js"></script>
    <script src="/assets/admin/js/products.js"></script>
</body>

</html>