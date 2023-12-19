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
    <title>Home - Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/home.css" type="text/css">
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='fa-solid fa-bars' id="header-toggle"></i></div>
        <div class="header_img"> <img src="https://gravatar.com/avatar/9942e2bf3f700a029b748508b1043c43?d=identicon" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class='fa-brands fa-bootstrap nav_logo-icon'></i> <span class="nav_logo-name">XStore</span>
                </a>
                <div class="nav_list">
                    <a href="/admin" class="nav_link active">
                        <i class="fa-solid fa-gauge nav_icon"></i> <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="/admin/users" class="nav_link">
                        <i class="fa-solid fa-user nav_icon"></i> <span class="nav_name">Users</span>
                    </a>
                    <a href="/admin/products" class="nav_link">
                        <i class='fa-solid fa-store nav_icon'></i> <span class="nav_name">Products</span>
                    </a>
                    <a href="/admin/orders" class="nav_link">
                        <i class="fa-solid fa-box-open nav_icon"></i> <span class="nav_name">Orders</span> </a>
                </div>
            </div> <a href="#" class="nav_link"> <i class='fa-solid fa-door-open nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/admin/js/home.js"></script>
</body>

</html>