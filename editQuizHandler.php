<?php
include 'header.php';

// Edit quiz name
if(isset($_POST['editQuiz'])) {
    $quiz_id = mysqli_real_escape_string($con, $_POST['quiz_id']);
    $quiz_name = mysqli_real_escape_string($con, $_POST['quiz_name']);

    $sql = "UPDATE quizzes SET quiz_name = '$quiz_name' WHERE quiz_id = '$quiz_id'";
    mysqli_query($con, $sql);

    // Sets global quiz_name variable
    $_SESSION['current_quiz_name'] = $quiz_name;

    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');
}

// Add quiz
else if(isset($_POST['addQuiz'])) {
    $sql = "INSERT INTO quizzes (quiz_name) VALUES ('Untitled quiz')";
    mysqli_query($con, $sql);

    // Sets notification and returns user to original page
    $_SESSION['added_quiz'] = true;
    header('Location: quizzes.php');
}

// Delete quiz
else if(isset($_POST['deleteQuiz'])) {
    $quiz_id = mysqli_real_escape_string($con, $_POST['quiz_id']);
    $quiz_name = mysqli_real_escape_string($con, $_POST['quiz_name']);
    
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
else if(isset($_POST['editFlashcards'])) {
    $question = mysqli_real_escape_string($con, $_POST['question']);
    $answer = mysqli_real_escape_string($con, $_POST['answer']);
    $flashcard_id = mysqli_real_escape_string($con, $_POST['flashcard_id']);

    $sql = "UPDATE flashcards SET question = '$question', answer = '$answer' WHERE flashcard_id = '$flashcard_id'";
    mysqli_query($con, $sql);

    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');
}

// Delete flashcards
else if(isset($_POST['deleteFlashcards'])) {
    $flashcard_id = mysqli_real_escape_string($con, $_POST['flashcard_id']);
    $sql = "DELETE FROM flashcards WHERE flashcard_id = '$flashcard_id'";
    mysqli_query($con, $sql);
    
    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');
}

// Add flashcards
else if(isset($_POST['addFlashcards'])) {
    $quiz_id = mysqli_real_escape_string($con, $_POST['quiz_id']);
    $question = mysqli_real_escape_string($con, $_POST['question']);
    $answer = mysqli_real_escape_string($con, $_POST['answer']);

    $sql = "INSERT INTO flashcards (quiz_id, question, answer) VALUES ('$quiz_id', '$question', '$answer')";
    mysqli_query($con, $sql);

    // Sets notification and returns user to original page
    $_SESSION['updated_quiz'] = true;
    header('Location: editQuiz.php');    
}
?>