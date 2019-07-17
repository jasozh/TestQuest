<?php include 'header.php'; ?>
<div class='body'>
    <div class='container'>
        <?php
        $quiz_id = $_POST['quiz_id'];
        $quiz_name = $_POST['quiz_name'];

        echo "<h1>$quiz_name</h1>";
        $sql = "SELECT * FROM flashcards WHERE `quiz_id` = '$quiz_id'";
        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)) {
            $flashcard_id = $row['flashcard_id'];
            $question = $row['question'];
            $answer = $row['answer'];

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