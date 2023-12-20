<?php
session_start();
include("database/database-connection.php");
include("database/check-login.php");

$user_data = check_login($con);
$current_user_email = $user_data['user_email'];
$current_user_name = $user_data['user_name'];

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $selectedAnswers = $_POST['answers'] ?? 0;
    $test_category = $_POST['test_category'];

    $correctAnswersQuery = "SELECT * FROM test_questionnaire WHERE category = '$test_category'";
    $correctAnswersResult = mysqli_query($con, $correctAnswersQuery);

    if ($correctAnswersResult) {
        $correctAnswers = [];
        $score = 0;

        while ($answer = mysqli_fetch_array($correctAnswersResult)) {
            $correctAnswer = [
                'question_no' => $answer['question_no'],
                'question' => $answer['question'],
                'answer' => $answer['answer'],
                'category' => $answer['category']
            ];

            $correctAnswer['correctAnswers'] = $correctAnswers;
            array_push($correctAnswers, $correctAnswer);
        }

        $data['current_user_name'] = $current_user_name;
        $data['current_user_email'] = $current_user_email;
        $data['correctAnswers'] = $correctAnswers;
        $data['status'] = "success";
    } else {
        $data['status'] = "error";
        $data['message'] = "Failed to retrieve correct answers from the database.";
    }
}

echo json_encode($data);
?>