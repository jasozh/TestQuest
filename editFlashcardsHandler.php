<?php
include 'header.php';

$question = $_POST['question'];
$answer = $_POST['answer'];
$flashcard_id = $_POST['flashcard_id'];

$sql = "UPDATE flashcards SET question = '$question', answer = '$answer' WHERE flashcard_id = '$flashcard_id'";
mysqli_query($con, $sql);

$_SESSION['updated_quiz'] = true;

header('Location: editQuiz.php')
?>