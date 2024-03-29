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
        $adminId = (int)$payload["id"];
        /**
         * @var Admin $currentAdmin
         */
        $currentAdmin = $repo->get(Admin::class, array("id" => $adminId));
        if ($currentAdmin == null) {
            http_response_code(302);
            header("Location: /admin/login");
            exit;
        }
        define("CURRENT_ADMIN", $currentAdmin->getUsername());
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
    <title>Home - Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/home.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/left-navbar.css" type="text/css">
</head>

<body id="body-pd" class="bg-light">
    <header class="xstore-header" id="header">
        <div class="xstore-header-toggle" id="header-toggle"> <i class='fa-solid fa-bars'></i></div>
        <div class="xstore-header-img"> <img src="https://gravatar.com/avatar/9942e2bf3f700a029b748508b1043c43?d=identicon" alt=""> </div>
    </header>
    <div class="xstore-l-navbar" id="nav-bar">
        <nav class="xstore-nav">
            <div>
                <a href="/" class="xstore-nav-logo">
                    <i class='fa-solid fa-layer-group xstore-nav-logo-icon'></i> <span class="xstore-nav-logo-name">XStore</span>
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
                        <i class="fa-solid fa-shield-halved xstore-nav-icon"></i> <span class="xstore-nav-name">Admins</span>
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
    <?php
    $sizeOfUsers = Views::getSizeOfUsers($bus->getUow());
    $sizeOfProducts = Views::getSizeOfProducts($bus->getUow());
    $sizeOfOrders = Views::getSizeOfOrders($bus->getUow());
    $sizeOfAdmins = Views::getSizeOfAdmins($bus->getUow());
    ?>
    <div class="bg-light">
        <div class="container">
            <div class="row row-cols-lg-3 row-cols-sm-1 row-cols-md-2">
                <div class="col">
                    <div class="d-flex flex-column shadow-sm p-3 bg-body rounded mt-3 gap-3">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <i class="fa-solid fa-shield-halved text-warning fs-4"></i> <span class="text-warning fs-4 fw-bold">Admins</span>
                        </div>
                        <?php
                        echo '<p class="fw-bold fs-5 gray-700">' . $sizeOfAdmins . '</p>'
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column shadow-sm p-3 bg-body rounded mt-3 gap-3">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <i class="fa-solid fa-user text-danger fs-4"></i> <span class="text-danger fs-4 fw-bold">Users</span>
                        </div>
                        <?php
                        echo '<p class="fw-bold fs-5 gray-700">' . $sizeOfUsers . '</p>'
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column shadow-sm p-3 bg-body rounded mt-3 gap-3">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <i class="fa-solid fa-store text-success fs-4"></i> <span class="text-success fs-4 fw-bold">Products</span>
                        </div>
                        <?php
                        echo '<p class="fw-bold fs-5 gray-700">' . $sizeOfProducts . '</p>'
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column shadow-sm p-3 bg-body rounded mt-3 gap-3">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <i class="fa-solid fa-box-open text-info fs-4"></i> <span class="text-info fs-4 fw-bold">Orders</span>
                        </div>
                        <?php
                        echo '<p class="fw-bold fs-5 gray-700">' . $sizeOfOrders . '</p>'
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/admin/js/home.js"></script>
    <script src="/assets/admin/js/left-navbar.js"></script>
</body>

</html>