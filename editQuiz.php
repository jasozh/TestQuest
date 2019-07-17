<?php include 'header.php'; ?>

<div class='body'>
    <div class='container'>
        <?php
            // Resets alerts
            if(isset($_SESSION['updated_quiz'])) {
                echo "<div class='alert alert-success'>Quiz updated.</div>";
                unset($_SESSION['updated_quiz']);
            }

            // If user is coming from quizzes.php, change global quiz variable
            if(isset($_GET['edit'])) {
                $_SESSION['current_quiz_id'] = $_GET['quiz_id'];
                $_SESSION['current_quiz_name'] = $_GET['quiz_name'];
            }

            // Local variables are always set to global ones
            $quiz_id = $_SESSION['current_quiz_id'];
            $quiz_name = $_SESSION['current_quiz_name'];

            // Edit quiz name
            echo "
            <form action='editQuizHandler.php' method='GET'>
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

                // Edit flashcards
                echo "
                <br>
                <form action='editQuizHandler.php' method='GET'>
                    <input type='text' name='question' value='$question'>
                    <input type='text' name='answer' value='$answer'>
                    <input type='hidden' name='flashcard_id' value='$flashcard_id'>
                    <button type='submit' name='editFlashcards' value='true' class='btn btn-primary'>Update</button>
                    <button type='submit' name='deleteFlashcards' value='true' class='btn btn-danger'>Delete</button>
                </form>
                ";
            }

            echo "
            <br>
            <form action='editQuizHandler.php' method='GET'>
                <input type='text' name='question' placeholder='Enter question'>
                <input type='text' name='answer' placeholder='Enter answer'>
                <input type='hidden' name='quiz_id' value='$quiz_id'>
                <button type='submit' name='addFlashcards' value='true' class='btn btn-primary'>Add Flashcard</button>
            </form>
            ";
            printf("Error: %s\n", mysqli_error($con));
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>