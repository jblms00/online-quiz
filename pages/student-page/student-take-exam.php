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
    <title>What Can I?</title>
</head>

<body class="student-te-page student-index-page">
    <nav class="navbar navbar-expand-lg bg-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="student-index-page.php">What Can I?</a>
            <ul class="navbar-nav mb-2 mb-lg-0 me-5">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="student-index-page.php">Home</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link active" href="#">Take Test</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="student-test-result.php">Test Results</a>
                </li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                    <p class="mb-0 mx-2">
                        <?php echo $user_name; ?>
                    </p>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="../../includes/user-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-container">
        <div class="container-fluid subtests-description" id="subTestsContainer"></div>
    </div>
    </div>
    <div class="footer-clean">
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-center">
                        <p class="mb-0">What Can I? © 2023</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <button type="button" class="btn btn-primary btn-back-to-top" id="btn-back-to-top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="modalConfirmTest" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered confirmation-dialog" id="testConfirmationDialog"></div>
    </div>
</body>


<script src="../../js/jquery-3.6.1.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/scroll-to-top-script.js"></script>
<script src="../../js/student-side.js"></script>

</html>