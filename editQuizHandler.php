<?php
include 'header.php';

$quiz_id = $_POST['quiz_id'];
$quiz_name = $_POST['quiz_name'];

if(isset($_POST['changeName'])) {
    $sql = "UPDATE quizzes SET quiz_name = '$quiz_name' WHERE quiz_id = '$quiz_id";
    mysqli_query($con, $sql);
}

$_SESSION['updated_quiz'] = true;

header('Location: editQuiz.php')
?>