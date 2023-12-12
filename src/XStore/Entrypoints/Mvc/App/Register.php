<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - XStore</title>
</head>

<body>

</body>

</html>

<?php

use XStore\Domains\Commands\CreateUserCommand;
use XStore\X\Response\HttpStatusCode;

use function XStore\bootstrap;
// use function XStore\get_user_by_id;

require_once __DIR__ . "/../../../Bootstrap.php";
// require_once __DIR__ . "/../../../Views.php";

$bus = bootstrap();

// // $command = new CreateUserCommand("hello world");
// // $bus->handle($command);

// http_response_code(HttpStatusCode::OK);
// header("Content-Type: application/json");
// echo json_encode(get_user_by_id(uow: $bus->get_uow(), id: 6));
