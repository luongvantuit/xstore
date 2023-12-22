<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XStore - Order</title>
    <?php
    require_once __DIR__ . "/../Common/Links.php";
    ?>
</head>

<body>
    <?php
    require_once __DIR__ . "/../Common/Header.php";
    ?>

    <?php

    use XStore\Domains\Models\User;
    use XStore\X\Jw\Jwt;
    use XStore\Configs;
    use XStore\Domains\Models\Order;

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
            if ($currentUser == null) {
                http_response_code(302);
                header("Location: /login");
                exit;
            }
        } catch (Exception $e) {
            http_response_code(302);
            header("Location: /login");
            exit;
        }
    } else {
        header("Location: /login");
        exit();
    }
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        http_response_code(302);
        header("Location: /orders");
        exit;
    } else {
        /**
         * @var Order $currentOrder
         */
        $currentOrder = $repo->get(Order::class, array("id" => (int)$_GET["id"]));
        if ($currentOrder == null) {
            http_response_code(302);
            header("Location: /orders");
            exit;
        }
    }
    ?>

    <div>

    </div>




    <?php
    require_once __DIR__ . "/../Common/Footer.php";
    require_once __DIR__ . "/../Common/Scripts.php";
    ?>
</body>

</html>