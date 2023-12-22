<?php

use XStore\Domains\Models\User;
use XStore\X\Jw\Jwt;
use XStore\Configs;
use XStore\Views;

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
        $id = (int)$payload["id"];
        /**
         * @var User $currentUser
         */
        $currentUser = $repo->get(User::class, array("id" => $id));
    } catch (Exception $e) {
        error_log($e, LOG_INFO);
    }
}
?>
<link rel="stylesheet" href="/assets/css/style.css" type="text/css">
<header class="header-section">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="logo">
                <img src="/assets/img/logo.png" alt="">
            </div>
            <div class="header-right">
                <img src="/assets/img/icons/search.png" alt="" class="search-trigger">
                <!-- <img src="/assets/img/icons/man.png" alt=""> -->
                <a href="/cart">
                    <img src="/assets/img/icons/bag.png" alt="">
                    <?php
                    if ($currentUser != null) {
                        echo '<span>' . (Views::getTotalInCartOfUser($bus->getUow(), $currentUser->getId())) . '</span>';
                    }
                    ?>
                </a>
            </div>
            <div class="user-access">
                <?php
                if ($currentUser == null) {
                    echo '
                    <a href="/register">Sign Up</a>
                    <a href="/login" class="in">Sign In</a>
                    ';
                } else {
                    echo '<button id="btn-sign-out" class="btn btn-primary">Sign Out</button>';
                }
                ?>

            </div>
            <nav class="main-menu mobile-menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/products">Products</a></li>
                    <?php
                    if ($currentUser != null) {
                        echo '<li><a href="/orders">Orders</a></li>';
                    } else {
                        echo '<li><a href="/login">Orders</a></li>';
                    }
                    ?>

                </ul>
            </nav>

        </div>
    </div>
</header>