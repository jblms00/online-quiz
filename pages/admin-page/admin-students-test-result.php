<?php
session_start();

include("../../includes/database/database-connection.php");
include("../../includes/database/check-login.php");

$user_data = check_login($con);
$user_name = $user_data['user_name'];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS and Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>What Can I? | Admin</title>
</head>

<body class="admin-index-page">
    <nav class="navbar navbar-expand-lg bg-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin-index-page.php">What Can I?</a>
            <ul class="navbar-nav mb-2 mb-lg-0 me-5">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="admin-index-page.php">Home</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link active" href="#">Students Test Results</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="admin-manage-students.php">Manage Students</a>
                </li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                    <p class="mb-0 mx-2">
                        <?php echo ucfirst($user_name); ?>
                    </p>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="../../includes/user-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-container">
        <div class="container-fluid container-dashboard">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered border-dark text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Score</th>
                                <th scope="col">Test Type</th>
                                <th scope="col">Test Taken At</th>
                            </tr>
                        </thead>
                        <tbody id="displayStudentsResults"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../../js/jquery-3.6.1.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/admin-display-test-results.js"></script>

</html>