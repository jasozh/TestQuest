<?php include 'header.php'; ?>

<div class='body'>
    <div class='container'>
        <?php
        // Resets alerts
        if(isset($_SESSION['updated_quiz'])) {
            echo "<div class='alert alert-success'>Quiz updated.</div>";
            unset($_SESSION['updated_quiz']);
        }

        // If user is coming from flashcards.php, change global quiz variable
        if(isset($_GET['edit'])) {
            $_SESSION['current_quiz_id'] = mysqli_real_escape_string($con, $_GET['quiz_id']);
            $_SESSION['current_quiz_name'] = mysqli_real_escape_string($con, $_GET['quiz_name']);
        }

        // Local variables are always set to global ones
        $quiz_id = $_SESSION['current_quiz_id'];
        $quiz_name = $_SESSION['current_quiz_name'];

        // Edit quiz name
        echo "
        <form action='editQuizHandler.php' method='POST'>
            <div class='row'>
                <div class='col-sm-4'>
                    <input type='text' class='form-control' name='quiz_name' value='$quiz_name' placeholder='Enter quiz name'>
                    <input type='hidden' name='quiz_id' value='$quiz_id'>
                </div>
                <div class='col-sm-2'>
                    <button type='submit' name='editQuiz' value='true' class='btn btn-primary btn-block'>Update</button>
                </div>
            </div>
        </form>
        <br>
        ";

        $sql = "SELECT * FROM flashcards f, quizzes q WHERE f.quiz_id = '$quiz_id' AND q.quiz_id = '$quiz_id'";
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
            $flashcard_id = htmlspecialchars($row['flashcard_id'], ENT_QUOTES);
            $question = htmlspecialchars($row['question'], ENT_QUOTES);
            $answer = htmlspecialchars($row['answer'], ENT_QUOTES);

            // Edit flashcards
            echo "
            <br>
            <form action='editQuizHandler.php' method='POST'>
            <div class='row'>
                <div class='col-sm-4'>
                    <textarea rows='1' class='form-control expanding' name='question' placeholder='Enter question' required>$question</textarea>
                </div>
                <div class='col-sm-4'>
                    <textarea rows='1' class='form-control expanding' name='answer' placeholder='Enter answer' required>$answer</textarea>
                    <input type='hidden' name='flashcard_id' value='$flashcard_id'>
                </div>
                <div class='col-sm-3'>
                    <div class='btn-group btn-block'>
                        <button type='submit' name='editFlashcards' value='true' class='btn btn-primary'>Update</button>
                        <button type='submit' name='deleteFlashcards' value='true' class='btn btn-danger'>Delete</button>
                    </div>
                </div>
            </div>
            </form>
            ";
        }

        echo "
        <br>
        <form action='editQuizHandler.php' method='POST'>
        <div class='row'>
            <div class='col-sm-4'>
                <textarea rows='1' class='form-control expanding' name='question' placeholder='Enter question' required></textarea>
            </div>
            <div class='col-sm-4'>
                <textarea rows='1' class='form-control expanding' name='answer' placeholder='Enter answer' required></textarea>
                <input type='hidden' name='quiz_id' value='$quiz_id'>
            </div>
            <div class='col-sm-3'>
                <div class='btn-group btn-block'>
                    <button type='submit' name='addFlashcards' value='true' class='btn btn-primary'>Insert</button>
                    <button type='reset' class='btn btn-secondary'>Clear</button>
                </div>
            </div>
        </form>
        ";
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>