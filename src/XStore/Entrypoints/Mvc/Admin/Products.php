<?php

use XStore\Domains\Models\Admin;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;

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
        <div class="xstore-header-img"> <img src="https://gravatar.com/avatar/9942e2bf3f700a029b748508b1043c43?d=identicon" alt=""> </div>
    </header>
    <div class="xstore-l-navbar" id="nav-bar">
        <nav class="xstore-nav">
            <div>
                <a href="/" class="xstore-nav-logo">
                    <i class='fa-solid fa-layer-group xstore-nav-logo-icon'></i> <span class="xstore-nav-logo-name">XStore</span>
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
                    <button type="button" class="btn btn-danger" id="btn-signout">Yes/SignOut</button>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light">
    </div>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/admin/js/need-authentization.js"></script>
    <script src="/assets/admin/js/left-navbar.js"></script>
</body>

</html>