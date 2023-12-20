<?php
session_start();

include("database/database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users_accounts WHERE user_type = 'student'";
    $totalUsersResult = mysqli_query($con, $totalUsersQuery);
    $totalUsers = mysqli_fetch_assoc($totalUsersResult)['total_users'];

    $activeUsersQuery = "SELECT COUNT(*) AS active_users FROM users_accounts WHERE user_status = 'Online' AND user_type = 'student'";
    $activeUsersResult = mysqli_query($con, $activeUsersQuery);
    $activeUsers = mysqli_fetch_assoc($activeUsersResult)['active_users'];

    $data = [
        "status" => "success",
        "totalUsers" => $totalUsers,
        "activeUsers" => $activeUsers
    ];
}

echo json_encode($data);
?>