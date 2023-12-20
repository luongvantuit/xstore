<?php

use Doctrine\DBAL\Schema\View;
use XStore\Domains\Models\Admin;
use XStore\ServiceLayers\UnitOfWork\DoctrineUnitOfWork;
use XStore\Views;

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
    <title>Admin - Admins Manager</title>
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
                    <a href="/admin/products" class="xstore-nav-link">
                        <i class='fa-solid fa-store xstore-nav-icon'></i> <span class="xstore-nav-name">Products</span>
                    </a>
                    <a href="/admin/orders" class="xstore-nav-link">
                        <i class="fa-solid fa-box-open xstore-nav-icon"></i> <span class="xstore-nav-name">Orders</span>
                    </a>
                    <a href="/admin/admins" class="xstore-nav-link xstore-active">
                        <i class="fa-solid fa-shield-halved xstore-nav-icon"></i> <span class="xstore-nav-name">Admins</span>
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
                    <button type="button" class="btn btn-danger" id="btn-sign-out">Yes/SignOut</button>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light">
        <!-- Modal Add New A Admin -->
        <div class="modal fade" id="addUserModal" tabindex="0" aria-labelledby="addUserModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModal">Add New A Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form id="form-add-new-a-admin" class="d-flex flex-column justify-content-center gap-3 needs-validation" novalidate>
                                <div id="form-add-new-a-admin-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                    <strong>Error!</strong>
                                    <p id="form-add-new-a-admin-alert-message">You should check in on some of those fields below.</p>
                                </div>
                                <div class="form-group">
                                    <label for="input-username">Username</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" id="input-username" placeholder="username" required minlength="6">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div id="input-username-invalid-feedback-message" class="invalid-feedback">
                                            <!-- Invalid message -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-email">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" id="input-email" placeholder="email">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div id="input-email-invalid-feedback-message" class="invalid-feedback">
                                            Please enter a email!
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
                                <button id="btn-form-add-new-a-admin" type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel/Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_COOKIE["username"]) && $_COOKIE["username"] === "root") {
            echo '<button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addUserModal">Add Admin</button>';
        }
        ?>
        <?php
        // *
        $currentPage = $_GET["page"] ?? 0;
        if ($currentPage < 0) {
            $currentPage = 0;
        }
        $limit = $_GET["limit"] ?? 10;
        if ($limit == 0) {
            $limit = 10;
        }
        $admins = Views::getAdmins($bus->getUow(), limit: $limit, offset: $limit * $currentPage);
        ?>
        <table class="table table-striped table-bordered mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($index = 0; $index < sizeof($admins ?? []); $index++) {
                    echo '
                    <tr>
                            <td>
                                ' . $index . '
                            </td>
                        <td>' . $admins[$index]["username"] . '</td>
                        <td>' . $admins[$index]["email"] . '</td>
                        <td>' . $admins[$index]["created_at"] . '</td>
                        <td>' . $admins[$index]["updated_at"] . '</td>
                        <td>
                            <div class="modal fade" id="deleteAdminModel' . $admins[$index]["id"] . '" tabindex="-1" aria-labelledby="deleteAdminModelLabel' . $admins[$index]["id"] . '" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteAdminModelLabel' . $admins[$index]["id"] . '">Are you sure?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            You want delete admin <strong>' . $admins[$index]["username"] . '</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No/Close</button>
                                            <button type="button" class="btn btn-danger" onclick="deleteAdmin(' . $admins[$index]["id"] . ')">Yes/Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton' . $admins[$index]["id"] . '" data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $admins[$index]["id"] . '">
                                    <li><a class="dropdown-item" href="/admin/admin/edit?id=' . $admins[$index]["id"] . '">Edit</a></li>
                                    
                                    <li><a class="dropdown-item text-danger" href="#deleteAdminModel' . $admins[$index]["id"] . '" data-bs-toggle="modal">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>

        <?php
        // * Pagination
        $sizeOfAdmins = Views::getSizeOfAdmins($bus->getUow());
        $pageNumbers = ceil($sizeOfAdmins / $limit);
        $minRangePage = max(0, $currentPage - 2);
        $maxRangePage = min($pageNumbers - 1, $currentPage + 2);
        ?>
        <nav aria-label="admins navigation">
            <ul class="pagination">
                <?php
                echo '
                <li class="page-item">
                    <a class="page-link ' . ($currentPage > 0 ? "" : "btn disabled") . '" href="/admin/admins/?page=' . ($currentPage - 1) . '" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                ';
                if ($currentPage >= 3) {
                    echo '<li class="page-item"><a class="page-link" href="/admin/admins/?page=' . ($currentPage - 3) . '">...</a></li>';
                }
                foreach (range($minRangePage, $maxRangePage) as $pageNumber) {
                    echo '<li class="page-item"><a class="page-link" href="/admin/admins/?page=' . $pageNumber . '">' . $pageNumber . '</a></li>';
                }
                if ($currentPage < $pageNumbers - 3) {
                    echo ' <li class="page-item"><a class="page-link" href="/admin/admins/?page=' . ($currentPage + 3) . '">...</a></li>';
                }
                echo '
                <li class="page-item">
                    <a class="page-link ' . ($currentPage < $pageNumbers - 1 ? "" : "btn disabled") . '" href="/admin/admins/?page=' . ($currentPage + 1) . '" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                '
                ?>
            </ul>
        </nav>
    </div>


    <script src="/assets/admin/js/bootstrap.min.js"></script>
    <script src="/assets/admin/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/admin/js/fontawesome.min.js"></script>
    <script src="/assets/admin/js/jquery.min.js"></script>
    <script src="/assets/admin/js/need-authentization.js"></script>
    <script src="/assets/admin/js/left-navbar.js"></script>
    <script src="/assets/admin/js/admins.js"></script>
</body>

</html>