<?php

use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;

use function XStore\bootstrap;

require_once __DIR__ . "/../../../Bootstrap.php";

$bus = bootstrap();
/**
 * @var DoctrineUnitOfWork $uow
 */
$uow = $bus->getUow();
$repo = $uow->getRepository();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XStore - Login</title>
    <link rel="stylesheet" href="/assets/admin/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/login.css" type="text/css">
    <?php
    require_once __DIR__ . "/../Common/Links.php";
    ?>
</head>

<body style="height: 100vh;">
    <?php
    require_once __DIR__ . "/../Common/Header.php";
    ?>
    <div class="d-flex align-items-center justify-content-center h-75">
        <form id="form-login" class="rounded shadow bg-white d-flex flex-column p-3 justify-content-center gap-3 w-form-login needs-validation" novalidate>
            <div class="w-100 d-flex align-items-center justify-content-center my-3">
                <img src="/assets/admin/svgs/solid/layer-group.svg" class="w-25">
            </div>
            <p class="font-weight-bold h3 text-center">Welcome to <strong>XStore</strong></p>
            <div id="form-login-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                <strong>Error!</strong>
                <p id="form-login-alert-message">You should check in on some of those fields below.</p>
            </div>
            <div class="form-group">
                <label for="input-identify">Username or Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" class="form-control" id="input-identify" placeholder="username or email" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div id="input-identify-invalid-feedback-message" class="invalid-feedback">
                        Please enter your username of email!
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="input-password">Password</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="input-password" placeholder="password" minlength="6" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div id="input-password-invalid-feedback-message" class="invalid-feedback">
                        <!-- Invalid message -->
                    </div>
                </div>
            </div>
            <button id="btn-form-login" type="submit" class="btn btn-primary">Login</button>
            <p align="center" class="my-2">You haven't account?<a href="/register" class="link-primary px-1"><strong>Register</strong></a>
            </p>
        </form>
    </div>
    <?php
    require_once __DIR__ . "/../Common/Footer.php";
    require_once __DIR__ . "/../Common/Scripts.php";
    ?>
    <script src="/assets/app/js/login.js"></script>
</body>

</html>