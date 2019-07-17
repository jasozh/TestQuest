<?php
include 'header.php';

// Edit quiz name
if(isset($_GET['editQuiz'])) {
    $quiz_id = $_GET['quiz_id'];
    $quiz_name = $_GET['quiz_name'];

    $sql = "UPDATE quizzes SET quiz_name = '$quiz_name' WHERE quiz_id = '$quiz_id'";
    mysqli_query($con, $sql);

    // Sets global quiz_name variable
    $_SESSION['current_quiz_name'] = $quiz_name;

    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');
}

// Add quiz
else if(isset($_GET['addQuiz'])) {
    $sql = "INSERT INTO quizzes (quiz_name) VALUES ('Untitled quiz')";
    mysqli_query($con, $sql);

    // Sets notification and returns user to original page
    $_SESSION['added_quiz'] = true;
    header('Location: quizzes.php');
}

// Delete quiz
else if(isset($_GET['deleteQuiz'])) {
    $quiz_id = $_GET['quiz_id'];
    $quiz_name = $_GET['quiz_name'];
    
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

// Edit flashcards
else if(isset($_GET['editFlashcards'])) {
    $question = $_GET['question'];
    $answer = $_GET['answer'];
    $flashcard_id = $_GET['flashcard_id'];

    $sql = "UPDATE flashcards SET question = '$question', answer = '$answer' WHERE flashcard_id = '$flashcard_id'";
    mysqli_query($con, $sql);

    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');
}

// Delete flashcards
else if(isset($_GET['deleteFlashcards'])) {
    $flashcard_id = $_GET['flashcard_id'];
    $sql = "DELETE FROM flashcards WHERE flashcard_id = '$flashcard_id'";
    mysqli_query($con, $sql);
    
    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');
}

// Add flashcards
else if(isset($_GET['addFlashcards'])) {
    $quiz_id = $_GET['quiz_id'];
    $question = $_GET['question'];
    $answer = $_GET['answer'];

    $sql = "INSERT INTO flashcards (quiz_id, question, answer) VALUES ('$quiz_id', '$question', '$answer')";
    mysqli_query($con, $sql);

    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');    
}
?>