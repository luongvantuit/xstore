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
    <title>XStore - Register</title>
    <link rel="stylesheet" href="/assets/admin/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/app/css/register.css" type="text/css">
    <?php
    require_once __DIR__ . "/../Common/Links.php";
    ?>
</head>

<body style="height: 100vh;">
    <?php
    require_once __DIR__ . "/../Common/Header.php";
    ?>
    <div class="modal fade" id="goToLoginModal" tabindex="-1" aria-labelledby="goToLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="goToLoginModalLabel">Go to Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Congratulations, you have successfully registered
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No/Close</button>
                    <a href="/login" class="btn btn-success">Yes/Redirect</a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center h-75">
        <form id="form-register" class="rounded shadow bg-white d-flex flex-column p-3 justify-content-center gap-3 w-form-register needs-validation" novalidate>
            <div class="w-100 d-flex align-items-center justify-content-center my-3">
                <img src="/assets/admin/svgs/solid/layer-group.svg" class="w-25">
            </div>
            <div id="form-register-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                <strong>Error!</strong>
                <p id="form-register-alert-message">You should check in on some of those fields below.</p>
            </div>
            <div class="form-group">
                <label for="input-username">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" class="form-control" id="input-username" placeholder="username" required>
                    <div class=" valid-feedback">
                        Looks good!
                    </div>
                    <div id="input-username-invalid-feedback-message" class="invalid-feedback">
                        Please enter your username!
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="input-email">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" class="form-control" id="input-email" placeholder="email" required>
                    <div class=" valid-feedback">
                        Looks good!
                    </div>
                    <div id="input-email-invalid-feedback-message" class="invalid-feedback">
                        <!-- Invalid message -->
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
            <button id="btn-form-register" type="submit" class="btn btn-primary">Register</button>
            <p align="center" class="my-2">Back to<a href="/login" class="link-primary px-1"><strong>Login</strong></a>
            </p>
        </form>
    </div>
    <?php
    require_once __DIR__ . "/../Common/Footer.php";
    require_once __DIR__ . "/../Common/Scripts.php";
    ?>

    <script src="/assets/app/js/register.js"></script>
</body>

</html>