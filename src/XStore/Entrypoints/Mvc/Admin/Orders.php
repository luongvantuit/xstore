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
    <title>Orders</title>
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
                <a href="#/" class="xstore-nav-logo">
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
                    <a href="/admin/products" class="xstore-nav-link">
                        <i class='fa-solid fa-store xstore-nav-icon'></i> <span class="xstore-nav-name">Products</span>
                    </a>
                    <a href="/admin/orders" class="xstore-nav-link xstore-active">
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
        $orders = Views::getOrders($bus->getUow(), limit: $limit, offset: $limit * $currentPage);
        ?>
        <table class="table table-striped table-bordered mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>Type Shipping Fee</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($index = 0; $index < sizeof($orders ?? []); $index++) {
                    echo '
                    <tr>
                        <td>
                            ' . $index . '
                        </td>
                        <td>' . ($orders[$index]["user"]["username"] ?? "") . '</td>
                        <td>' . $orders[$index]["address_id"] . '</td>
                        <td>' . $orders[$index]["type_shipping_fee"] . '</td>
                        <td>' . $orders[$index]["status"] . '</td>
                        <td>' . $orders[$index]["created_at"] . '</td>
                        <td>' . $orders[$index]["updated_at"] . '</td>
                           <td>
                            <div class="modal fade" id="editOrderModal' . $orders[$index]["id"] . '" tabindex="-1" aria-labelledby="editOrderModalLabel' . $orders[$index]["id"] . '" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editOrderModalLabel' . $orders[$index]["id"] . '">Upgrade Status of Order?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>#:</strong>' . $index . '</p>
                                            <p><strong>Order ID:</strong> ' . $orders[$index]["id"] . '</p>
                                            <p><strong>Username:</strong> ' . $orders[$index]["user"]["username"] . '</p>
                                            <select id="input-status-order-' . $orders[$index]["id"] . '" class="form-select" aria-label="Status Order" value="' . $orders[$index]["status"] . '">
                                                <option value="incard">In Cart</option>
                                                <option value="pending">Pending</option>
                                                <option value="cancelled">Cancelled</option>
                                                <option value="delivering">Delivering</option>
                                                <option value="delivered">Delivered</option>
                                                <option value="returning">Returning</option>
                                                <option value="returned">Returned</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No/Close</button>
                                            <button type="button" class="btn btn-primary" onclick="updateOrder(' . $orders[$index]["id"] . ')">Yes/Summit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                            <a class="btn text-danger" href="#editOrderModal' . $orders[$index]["id"] . '" data-bs-toggle="modal">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class="btn text-primary" href="/admin/order?id=' . $orders[$index]["id"] . '">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                            </div>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
        <?php
        // * Pagination
        $sizeOfUsers = Views::getSizeOfOrders($bus->getUow());
        $pageNumbers = ceil($sizeOfUsers / $limit);
        $minRangePage = max(0, $currentPage - 2);
        $maxRangePage = min($pageNumbers - 1, $currentPage + 2);
        if ($pageNumbers == 0) {
            $maxRangePage = 0;
        }
        ?>
        <nav aria-label="Orders navigation">
            <ul class="pagination">
                <?php
                echo '
                <li class="page-item">
                    <a class="page-link ' . ($currentPage > 0 ? "" : "btn disabled") . '" href="/admin/orders/?page=' . ($currentPage - 1) . '" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                ';
                if ($currentPage >= 3) {
                    echo '<li class="page-item"><a class="page-link" href="/admin/orders/?page=' . ($currentPage - 3) . '">...</a></li>';
                }
                foreach (range($minRangePage, $maxRangePage) as $pageNumber) {
                    echo '<li class="page-item"><a class="page-link" href="/admin/orders/?page=' . $pageNumber . '">' . $pageNumber . '</a></li>';
                }
                if ($currentPage < $pageNumbers - 3) {
                    echo ' <li class="page-item"><a class="page-link" href="/admin/orders/?page=' . ($currentPage + 3) . '">...</a></li>';
                }
                echo '
                <li class="page-item">
                    <a class="page-link ' . ($currentPage < $pageNumbers - 1 ? "" : "btn disabled") . '" href="/admin/orders/?page=' . ($currentPage + 1) . '" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                '
                    ?>
            </ul>
        </nav>
    </div>
    <script src="/assets/admin/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/admin/js/left-navbar.js"></script>
    <script src="/assets/admin/js/orders.js"></script>
</body>

</html>