<?php
session_start();

include("database/database-connection.php");
include("database/check-login.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "SELECT * FROM users_accounts WHERE user_email = '$user_email'";
    $result = mysqli_query($con, $query);

    if (empty($user_email) && empty($user_password)) {
        $data['status'] = "error";
        $data['message'] = "Please enter your email and password";
    } else if (empty($user_email)) {
        $data['status'] = "error";
        $data['message'] = "Please enter your email";
    } else if (empty($user_password)) {
        $data['status'] = "error";
        $data['message'] = "Please enter your password";
    } else if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (base64_encode($user_password) !== $row['user_password']) {
            $data['status'] = "error";
            $data['message'] = "Incorrect password";
        } else {
            $_SESSION['user_email'] = $user_email;

            $data['session'] = $user_email;

            $data['user_type'] = $row['user_type'];
            $data['status'] = "success";
            $data['message'] = "Login successful";

            $update_status_query = "UPDATE users_accounts SET user_status = 'Online' WHERE user_id = '{$row['user_id']}'";
            mysqli_query($con, $update_status_query);
        }
    } else {
        $data['status'] = "error";
        $data['message'] = "Incorrect email";
    }
}

echo json_encode($data);
