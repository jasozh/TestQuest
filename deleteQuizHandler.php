<?php
include 'header.php';

echo "<div class='body'>";

$quiz_id = $_POST['quiz_id'];
$quiz_name = $_POST['quiz_name'];

// Delete quiz entry
$sql = "DELETE FROM quizzes WHERE quiz_id = '$quiz_id' AND quiz_name = '$quiz_name'";
mysqli_query($con, $sql);

// Delete all related  flashcards
$sql = "DELETE FROM flashcards WHERE quiz_id = '$quiz_id'";
mysqli_query($con, $sql);

$_SESSION['deleted_quiz'] = true;

header('Location: quizzes.php');
?>