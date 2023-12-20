<?php
session_start();
include("database/database-connection.php");
include("database/check-login.php");

$user_data = check_login($con);
$current_user_email = $user_data['user_email'];
$current_user_name = $user_data['user_name'];

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $test_category = $_POST['test_category'];
    $questionIdsString = $_POST['questionIdsString'];
    $selected_answers = $_POST['answers'];

    $questionIdsArray = explode('-', $questionIdsString);

    $questionQuery = "SELECT * FROM test_questionnaire WHERE category = '$test_category' AND id IN (" . implode(',', $questionIdsArray) . ")";
    $questionResult = mysqli_query($con, $questionQuery);

    if ($questionResult) {
        $questions = [];

        while ($questionData = mysqli_fetch_assoc($questionResult)) {
            $question = [
                'question_id' => $questionData['id'],
                'question_no' => $questionData['question_no'],
                'question' => $questionData['question'],
                'correct_answer' => $questionData['answer'],
                'category' => $questionData['category'],
                'user_answers' => $selected_answers,
            ];

            $questions[] = $question;
        }

        $data['questionIdsArray'] = $questionIdsArray;
        $data['current_user_name'] = $current_user_name;
        $data['current_user_email'] = $current_user_email;
        $data['questions'] = $questions;
        $data['status'] = "success";
    } else {
        $data['status'] = "error";
        $data['message'] = "Failed to retrieve questions from the database.";
    }
}

echo json_encode($data);
?>