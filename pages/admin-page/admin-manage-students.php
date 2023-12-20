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
                    <a class="nav-link" href="admin-students-test-result.php">Students Test Results</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link active" href="#">Manage Students</a>
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
                    <div class="btn-groups text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalAddStudent">Add Student</button>
                        <input type="text" id="searchStudent" placeholder="Search student name here..">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered border-dark text-center students-table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student Email</th>
                            </tr>
                        </thead>
                        <tbody id="displayStudents"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Students -->
    <div class="modal fade" id="modalAddStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="studentName" placeholder="John Doe">
                                    <label>Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="studentEmail"
                                        placeholder="name@example.com">
                                    <label>Email Address</label>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="studentPassword" placeholder="Password">
                                    <label>Password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../../js/jquery-3.6.1.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap.bundle.min.js"></script>
<script src="../../js/admin-display-students.js"></script>

</html>