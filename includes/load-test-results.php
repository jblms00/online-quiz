<?php
session_start();

include("database/database-connection.php");
include("database/check-login.php");

$user_data = check_login($con);
$current_user_email = $user_data['user_email'];
$current_user_name = $user_data['user_name'];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT * FROM test_results WHERE user_email = '$current_user_email' AND user_name = '$current_user_name'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data['results'] = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data['results'][] = $row;
        }
        $data['status'] = 'success';
    } else {
        $data["status"] = "error";
        $data["message"] = "No result found";
    }
}
echo json_encode($data);
?>