<?php

use XStore\Configs;
use XStore\Domains\Models\Admin;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\X\Jw\Jwt;

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
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/login.css" type="text/css">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <form id="form-login" class="rounded shadow bg-white d-flex flex-column p-3 justify-content-center gap-3 w-form-login needs-validation" novalidate>
            <div class="w-100 d-flex align-items-center justify-content-center">
                <img src="/assets/admin/svgs/solid/layer-group.svg" class="w-25">
            </div>
            <p class="font-weight-bold h3 text-center">Welcome to <strong>XStore</strong></p>
            <div id="form-login-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                <strong>Error!</strong>
                <p id="form-login-alert-message">You should check in on some of those fields below.</p>
            </div>
            <div class="form-group">
                <label for="input-username">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" class="form-control" id="input-username" placeholder="username" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div id="input-username-invalid-feedback-message" class="invalid-feedback">
                        Please enter your username!
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
            <button id="btn-form-login" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/app/js/login.js"></script>

</body>

</html>