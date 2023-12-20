<?php
session_start();

include("database/database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT * FROM users_accounts WHERE user_type = 'student' ORDER BY user_name ASC";
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