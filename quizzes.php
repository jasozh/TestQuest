<?php
include 'header.php';

$_SESSION['current_quiz_id'] = 0;
$_SESSION['current_quiz_id'] = 0;
?>

<div class='body'>
    <div class='container'>
        <?php
            if(isset($_SESSION['deleted_quiz'])) {
                echo "<div class='alert alert-danger'>Quiz deleted.</div>";
                unset($_SESSION['deleted_quiz']);
            }
            
            else if(isset($_SESSION['added_quiz'])) {
                echo "<div class='alert alert-success'>Quiz added.</div>";
                unset($_SESSION['added_quiz']);
            }

            $sql = "SELECT * FROM quizzes";
            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)) {
                $quiz_name = htmlspecialchars($row['quiz_name'], ENT_QUOTES);
                $quiz_id = htmlspecialchars($row['quiz_id'], ENT_QUOTES);

                echo "
                <form action='flashcards.php' method='GET' class='inline'>                
                    <input type='hidden' value='$quiz_id' name='quiz_id'>
                    <input type='hidden' value='$quiz_name' name='quiz_name'>
                    <button type='submit' name='flashcards' value='true' class='jumbotron quiz-card btn btn-light'>$quiz_name</button>
                </form>
                ";
            }

            echo "
            <form action='editQuizHandler.php' method='POST' class='inline'>                
                <button type='submit' name='addQuiz' value='true' class='jumbotron quiz-card btn btn-success'>+ Add Quiz</button>
            </form>
            ";
            ?>
    </div>
</div>
<?php include 'footer.php'; ?>