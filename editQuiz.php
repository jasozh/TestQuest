<?php
include 'header.php';

// Sets notification variables to false by default
if(!isset($_SESSION['updated_quiz'])) {
    $_SESSION['updated_quiz'] = false;
}
?>

<div class='body'>
    <div class='container'>
        <?php
            // Resets alerts to false
            if($_SESSION['updated_quiz'] == true) {
                echo "<div class='alert alert-success'>Quiz updated.</div>";
                $_SESSION['updated_quiz'] = false;
            }

            // Editing flashcards

            // If user is coming from quizzes.php, retrieve form information. Otherwise, use stored session variables
            if(isset($_POST['edit'])) {
                $quiz_id = $_POST['quiz_id'];
                $quiz_name = $_POST['quiz_name'];
                $_SESSION['current_quiz_id'] = $quiz_id;
                $_SESSION['current_quiz_name'] = $quiz_name;
            } else {
                $quiz_id = $_SESSION['current_quiz_id'];
                $quiz_name = $_SESSION['current_quiz_name'];
            }
            echo "$quiz_id $quiz_name";
            // Name update currently broken
            echo "
            <form action='editQuizHandler.php' method='POST'>
                <input type='text' name='quiz_name' value='$quiz_name'>
                <input type='hidden' name='quiz_id' value='$quiz_id'>
                <button type='submit' name='editQuiz' value='true' class='btn btn-primary'>Update</button>
            </form>
            ";

            $sql = "SELECT * FROM flashcards f, quizzes q WHERE f.quiz_id = '$quiz_id' AND q.quiz_id = '$quiz_id'";
            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                $flashcard_id = $row['flashcard_id'];
                $question = $row['question'];
                $answer = $row['answer'];

                echo "
                <br>
                <form action='editQuizHandler.php' method='POST'>
                    <input type='text' name='question' value='$question'>
                    <input type='text' name='answer' value='$answer'>
                    <input type='text' name='flashcard_id' value='$flashcard_id'>
                    <button type='submit' name='editFlashcards' value='true' class='btn btn-primary'>Update</button>
                </form>
                ";
            }
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>