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
    header("Location: /admin");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Initial Password - Root Password</title>
    <link rel="stylesheet" href="/assets/bootstrap-5.0.2/css/bootstrap-grid.css" type="text/css">
    <link rel="stylesheet" href="/assets/bootstrap-5.0.2/css/bootstrap-grid.rtl.css" type="text/css">
    <link rel="stylesheet" href="/assets/bootstrap-5.0.2/css/bootstrap-reboot.css" type="text/css">
    <link rel="stylesheet" href="/assets/bootstrap-5.0.2/css/bootstrap-reboot.rtl.css" type="text/css">
    <link rel="stylesheet" href="/assets/bootstrap-5.0.2/css/bootstrap-reboot.rtl.min.css" type="text/css">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center h-100 w-100">
        <form action="" class="rounded shadow-sm w-25 bg-white d-flex flex-column p-3 justify-content-center form-gap">
            <p class="font-weight-bold h3 text-center">Setup Root Password</p>
            <div class="form-group">
                <label for="input-password">Password</label>
                <input type="password" class="form-control" id="input-password" placeholder="Password" minlength="6" required>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
    </div>

    <script src="/assets/bootstrap-5.0.2/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <script src="/assets/bootstrap-5.0.2/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/bootstrap-5.0.2/js/jquery.slicknav.js"></script>
    <script src="/assets/bootstrap-5.0.2/js/owl.carousel.min.js"></script>
    <script src="/assets/bootstrap-5.0.2/js/jquery.nice-select.min.js"></script>
    <script src="/assets/bootstrap-5.0.2/js/mixitup.min.js"></script>
    <script src="/assets/bootstrap-5.0.2/js/main.js"></script>
</body>

</html>