<?php
include 'header.php';

if(isset($_POST['editQuiz'])) {
    $quiz_id = $_POST['quiz_id'];
    $quiz_name = $_POST['quiz_name'];

    $sql = "UPDATE quizzes SET quiz_name = '$quiz_name' WHERE quiz_id = '$quiz_id'";
    mysqli_query($con, $sql);

    // Sets global quiz_name variable
    $_SESSION['current_quiz_name'] = $quiz_name;

    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');
}

else if(isset($_POST['editFlashcards'])) {
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $flashcard_id = $_POST['flashcard_id'];

    $sql = "UPDATE flashcards SET question = '$question', answer = '$answer' WHERE flashcard_id = '$flashcard_id'";
    mysqli_query($con, $sql);

    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');
}

else if(isset($_POST['deleteQuiz'])) {
    $quiz_id = $_POST['quiz_id'];
    $quiz_name = $_POST['quiz_name'];
    
    // Delete quiz entry
    $sql = "DELETE FROM quizzes WHERE quiz_id = '$quiz_id' AND quiz_name = '$quiz_name'";
    mysqli_query($con, $sql);
    
    // Delete all related flashcards
    $sql = "DELETE FROM flashcards WHERE quiz_id = '$quiz_id'";
    mysqli_query($con, $sql);
    
    // Sets notification and returns user to original page
    $_SESSION['deleted_quiz'] = true;
    header('Location: quizzes.php');
}
?>