<?php
session_start();

include("database/database-connection.php");
include("database/check-login.php");

$user_data = check_login($con);
$current_user_email = $user_data['user_email'];
$current_user_name = $user_data['user_name'];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT DISTINCT test_category FROM test_results WHERE user_email = '$current_user_email' AND user_name = '$current_user_name'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row['test_category'];
        }
        $data["status"] = "success";
        $data["categories"] = $categories;
    } else {
        $data["status"] = "error";
    }
}

echo json_encode($data);
?>