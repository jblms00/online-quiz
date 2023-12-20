<?php
session_start();

include("database/database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_email = $_POST['user_email'];
    $user_name = $_POST['user_name'];
    $test_id = $_POST['test_id'];

    $query = "SELECT * FROM test_results WHERE user_email = '$user_email' AND user_name = '$user_name' AND test_id = '$test_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Extract test scores
        $user_score = $row['user_score'];

        // Recommendations based on Verbal Ability
        if ($user_score == 1 && $row['test_category'] === 'Verbal Ability') {
            $data["work_recommended"] = "Data Entry Clerk";
            $data["description"] = "Individuals with a Verbal Ability score of 1 may find success in roles that require focused attention to detail. A Data Entry Clerk position is suitable, as it involves working with written information, ensuring accuracy, and organizing data.";
        } elseif ($user_score == 2 && $row['test_category'] === 'Verbal Ability') {
            $data["work_recommended"] = "Customer Service Representative";
            $data["description"] = "A score of 2 in Verbal Ability suggests good communication skills. A Customer Service Representative role is recommended, as it involves interacting with customers, addressing queries, and resolving issues effectively.";
        } elseif ($user_score == 3 && $row['test_category'] === 'Verbal Ability') {
            $data["work_recommended"] = "Copywriter";
            $data["description"] = "With a score of 3, individuals may excel in roles that demand creative expression. A Copywriter position is suitable, utilizing strong verbal skills to create engaging and persuasive written content.";
        } elseif ($user_score == 4 && $row['test_category'] === 'Verbal Ability') {
            $data["work_recommended"] = "Journalist";
            $data["description"] = "Those with a Verbal Ability score of 4 may thrive in roles that demand high-level communication and research. A Journalist position is recommended, involving investigative reporting, writing, and storytelling.";
        } elseif ($user_score == 5 && $row['test_category'] === 'Verbal Ability') {
            $data["work_recommended"] = "Public Relations Specialist";
            $data["description"] = "A high score in Verbal Ability indicates advanced communication skills. A Public Relations Specialist role is ideal, requiring the ability to craft compelling narratives, manage relationships, and communicate effectively with diverse audiences.";
        } elseif ($user_score == 1 && $row['test_category'] === 'Numerical Ability') {
            $data["work_recommended"] = "Data Entry Clerk";
            $data["description"] = "Individuals with basic skills in both verbal and numerical abilities are well-suited for a Data Entry Clerk position. This role involves accurate data entry, requiring attention to detail in both verbal and numerical contexts.";
        } elseif ($user_score == 2 && $row['test_category'] === 'Numerical Ability') {
            $data["work_recommended"] = "Customer Service Representative";
            $data["description"] = "With balanced skills in verbal and numerical abilities, a Customer Service Representative role is recommended. This position involves effective communication and handling numerical data related to customer inquiries and issues.";
        } elseif ($user_score == 3 && $row['test_category'] === 'Numerical Ability') {
            $data["work_recommended"] = "Administrative Assistant";
            $data["description"] = "Individuals with moderate proficiency in both verbal and numerical abilities may excel as Administrative Assistants. This role involves organizing information, managing tasks, and providing support in both verbal and numerical contexts.";
        } elseif ($user_score == 4 && $row['test_category'] === 'Numerical Ability') {
            $data["work_recommended"] = "Financial Analyst";
            $data["description"] = "With advanced skills in both verbal and numerical abilities, a Financial Analyst role is suitable. This position involves analyzing financial data, requiring strong communication and numerical analysis capabilities.";
        } elseif ($user_score == 5 && $row['test_category'] === 'Numerical Ability') {
            $data["work_recommended"] = "Marketing Strategist";
            $data["description"] = "Individuals with exceptional skills in both verbal and numerical abilities are well-suited for a Marketing Strategist role. This position involves crafting marketing strategies, combining advanced communication and numerical analysis.";
        } elseif ($user_score == 1 && $row['test_category'] === 'Science Test') {
            $data["work_recommended"] = "Data Entry Clerk";
            $data["description"] = "Individuals with basic skills in Verbal, Numerical, and Science tests are well-suited for a Data Entry Clerk position. This role involves accurate data entry and attention to detail in various contexts.";
        } elseif ($user_score == 2 && $row['test_category'] === 'Science Test') {
            $data["work_recommended"] = "Customer Service Representative";
            $data["description"] = "With balanced skills in Verbal, Numerical, and Science tests, a Customer Service Representative role is recommended. This position involves effective communication, numerical handling, and basic science-related knowledge.";
        } elseif ($user_score == 3 && $row['test_category'] === 'Science Test') {
            $data["work_recommended"] = "Office Administrator";
            $data["description"] = "Individuals with moderate proficiency in Verbal, Numerical, and Science tests may excel as Office Administrators. This role involves overseeing administrative tasks, data management, and coordinating science-related activities if necessary.";
        } elseif ($user_score == 4 && $row['test_category'] === 'Science Test') {
            $data["work_recommended"] = "Research Analyst";
            $data["description"] = "With advanced skills in Verbal, Numerical, and Science tests, a Research Analyst role is suitable. This position involves conducting research, data analysis, and understanding scientific principles.";
        } elseif ($user_score == 5 && $row['test_category'] === 'Science Test') {
            $data["work_recommended"] = "Scientific Communicator";
            $data["description"] = "Individuals with exceptional skills in Verbal, Numerical, and Science tests are well-suited for a role as a Scientific Communicator. This position involves translating complex scientific concepts into accessible content for various audiences.";
        } else {
            $data["work_recommended"] = "Science Education Coordinator";
            $data["description"] = "Based on your unique combination of Verbal, Numerical, and Science scores, a role as a Science Education Coordinator is recommended. This position involves developing educational programs, communicating scientific concepts, and supporting science education initiatives.";
        }

        $data["status"] = "success";
    } else {
        $data["status"] = "error";
        $data["message"] = "No result found";
    }
}
echo json_encode($data);
?>