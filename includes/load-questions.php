<?php
session_start();

include("database/database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $category = mysqli_real_escape_string($con, $_GET["category"]);
    $query = "SELECT * FROM test_questionnaire WHERE category = '$category'";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [
                'id' => $row['id'],
                'question' => $row['question'],
                'opt1' => $row['opt1'],
                'opt2' => $row['opt2'],
                'opt3' => $row['opt3'],
                'opt4' => $row['opt4']
            ];
        }
    }
}

echo json_encode($data);
