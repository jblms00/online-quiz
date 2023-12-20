<?php
session_start();
include("database/database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_score = $_POST['user_score'];
    $user_email = $_POST['user_email'];
    $user_name = $_POST['user_name'];
    $category = $_POST['category'];
    $test_id = rand(10000000, 99999999);

    $query = "INSERT INTO test_results (test_id, user_email, user_name, user_score, test_category, taken_at) VALUES ('$test_id','$user_email','$user_name','$user_score','$category', NOW())";
    $result = mysqli_query($con, $query);

    if ($result) {
        $data["test_id"] = $test_id;
        $data["status"] = 'success';
        $data['message'] = 'Successfuly inserted the data.';
    }
}

echo json_encode($data);
?>