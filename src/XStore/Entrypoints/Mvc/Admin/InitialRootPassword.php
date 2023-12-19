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
if ($model != null) {
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
    <title>Initial Password - Root Password</title>
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/admin/css/initial-root-password.css" type="text/css">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <form id="form-setup-root-password" class="rounded shadow bg-white d-flex flex-column p-3 justify-content-center gap-3 w-form-setup-root-password needs-validation" novalidate>
            <p class="font-weight-bold h3 text-center">Setup Root Password</p>
            <div id="form-setup-root-password-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                <strong>Error!</strong>
                <p id="form-setup-root-password-alert-message">You should check in on some of those fields below.</p>
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
            <button id="btn-form-setup-root-password" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/admin/js/initial-root-password.js"></script>
</body>

</html>