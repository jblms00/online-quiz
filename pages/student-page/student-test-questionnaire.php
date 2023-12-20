<?php
session_start();

include("../../includes/database/database-connection.php");
include("../../includes/database/check-login.php");

$user_data = check_login($con);
$user_email = $user_data['user_email'];
$user_name = $user_data['user_name'];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS and Bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>What Can I?</title>
</head>

<body class="student-test-que-page student-index-page" data-user-email="<?php echo $user_email; ?>"
    data-user-name="<?php echo $user_name; ?>">
    <nav class="navbar navbar-expand-lg bg-none">
        <div class="container-fluid">
            <a class="navbar-brand disabled" href="#">What Can I?</a>
            <ul class="navbar-nav mb-2 mb-lg-0 me-5">
                <li class="nav-item mx-3">
                    <a class="nav-link disabled not-active" href="#">Home</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link disabled active" href="#">Take Test</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link disabled not-active" href="#">Test Results</a>
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
                    <li><a class="dropdown-item disabled" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-container">
        <form id="studentTestForm" class="mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="user-timer" id="testTimer">15:00</div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-5" id="containerQuestionnaire"></div>
        </form>
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


    <div class="modal fade" id="modalMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="mb-0 text-center text-danger fw-semibold">Please complete all questions before submitting
                        the test.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>


<script src="../../js/jquery-3.6.1.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/scroll-to-top-script.js"></script>
<script src="../../js/student-side.js"></script>

</html>