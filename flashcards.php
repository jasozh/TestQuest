<?php include 'header.php'; ?>
<div class='body'>
    <div class='container'>
        <?php
        $quiz_id = mysqli_real_escape_string($con, $_GET['quiz_id']);
        $quiz_name = htmlspecialchars($_GET['quiz_name'], ENT_QUOTES);

        echo "
        <form action='editQuiz.php' method='GET' class='inline'>
            <input type='hidden' value='$quiz_id' name='quiz_id'>
            <input type='hidden' value='$quiz_name' name='quiz_name'>
            <button type='submit' name='edit' value='true' class='btn btn-primary'>Edit</button>
        </form>
        <form action='editQuizHandler.php' method='POST' class='inline'>
            <input type='hidden' value='$quiz_id' name='quiz_id'>
            <input type='hidden' value='$quiz_name' name='quiz_name'>
            <button type='submit' name='deleteQuiz' value='true' class='btn btn-danger'>Delete</button>
        </form>
        ";

        echo "<h1>$quiz_name</h1>";
        $sql = "SELECT * FROM flashcards WHERE `quiz_id` = '$quiz_id'";
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
            $flashcard_id = htmlspecialchars($row['flashcard_id'], ENT_QUOTES);
            $question = htmlspecialchars($row['question'], ENT_QUOTES);
            $answer = htmlspecialchars($row['answer'], ENT_QUOTES);

            echo "
            <div class='row'>
                <div class='col-sm-6'>
                    <div class='jumbotron'>$question</div>
                </div>
                <div class='col-sm-6'>
                    <div class='jumbotron'>$answer</div>
                </div>
            </div>
            ";
        }
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>