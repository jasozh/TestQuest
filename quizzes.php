<?php include 'header.php'; ?>

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
                $quiz_name = $row['quiz_name'];
                $quiz_id = $row['quiz_id'];

                echo "
                <form action='flashcards.php' method='POST' class='inline'>                
                    <input type='hidden' value='$quiz_id' name='quiz_id'>
                    <input type='hidden' value='$quiz_name' name='quiz_name'>
                    <button type='submit' class='jumbotron btn btn-warning'>$quiz_name</button>
                </form>
                <form action='editQuiz.php' method='POST' class='inline'>
                    <input type='hidden' value='$quiz_id' name='quiz_id'>
                    <input type='hidden' value='$quiz_name' name='quiz_name'>
                    <button type='submit' name='edit' value='true' class='btn btn-primary'>Edit</button>
                    <button type='submit' name='deleteQuiz' value='true' formaction='editQuizHandler.php' class='btn btn-danger'>Delete</button>
                </form>
                ";
            }
            ?>
    </div>
</div>
<?php include 'footer.php'; ?>