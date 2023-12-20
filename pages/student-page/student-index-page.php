<?php
session_start();

include("../../includes/database/database-connection.php");
include("../../includes/database/check-login.php");

$user_data = check_login($con);

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

<body class="student-index-page">
    <nav class="navbar navbar-expand-lg bg-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">What Can I?</a>
            <ul class="navbar-nav mb-2 mb-lg-0 me-5">
                <li class="nav-item mx-3">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="student-take-exam.php">Take Test</a>
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
                        <?php echo $user_data['user_name']; ?>
                    </p>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="../../includes/user-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-container">
        <div class="container-fluid index-description">
            <div class="row my-3">
                <div class="col">
                    <h5 class="fw-light">The MSA National Career Aptitude Exam Preparation is a complete guide that
                        contains a
                        self-administered and self-scored career-aptitude evaluation system especially designed to help
                        you be familiar with the many occupations available today. Now, you will be able to identify
                        career strengths and set realistic occupational goals crucial in your success later in life.
                    </h5>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <h5 class="fw-light">The test contains 8 subtests namely Verbal Ability, Numerical Ability, Science
                        Test,
                        Clerical Ability, Interpersonal Skills Test, Logical Reasoning, Entrepreneurship Test, and
                        Mechanical Ability. Each subtest will help you evaluate your capabilities. You will discover if
                        you
                        have the aptitude for business, if you can work rapidly and accurately with details, if you are
                        skilled in reasoning, if you can solve spacial relationships, or if you have the aptitude for
                        counseling and helping others with their personal problems.</h5>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <h5 class="fw-light">Through the MSA NCAE Preparation, you, and even your parents, will be guided
                        on what suitable
                        career
                        path is ideal to pursue, considering among other things, your mental capacity, aptitude, skills
                        and
                        interest.</h5>
                </div>
            </div>
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
</body>

<script src="../../js/jquery-3.6.1.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>

</html>