<?php
session_start();
include("database/database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_email = $_POST['user_email'];
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    if (empty($user_email) || empty($user_name) || empty($user_password)) {
        $data['status'] = "error";
        $data['message'] = "All fields are required";
    } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $data['status'] = "error";
        $data['message'] = "Invalid email format";
    } else {
        $checkQuery = "SELECT * FROM users_accounts WHERE user_email = '$user_email'";
        $checkResult = mysqli_query($con, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            $data['status'] = "error";
            $data['message'] = "Email address is already in use";
        } else {
            $new_encoded_password = base64_encode($user_password);
            $user_id = rand(10000000, 99999999);
            $query = "INSERT INTO users_accounts (user_id, user_email, user_name, user_password, user_status, user_type, created_at) VALUES ('$user_id','$user_email','$user_name','$new_encoded_password','Offline','student', NOW())";
            $result = mysqli_query($con, $query);

            if ($result) {
                $data['status'] = "success";
                $data['message'] = "<b>SUCCESS!</b>";
            } else {
                $data["status"] = "error";
                $data["message"] = "</b>Failed to add new student</b>";
            }
        }
    }
}

echo json_encode($data);
?>