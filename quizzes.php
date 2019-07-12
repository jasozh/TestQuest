<?php include 'header.php'; ?>
<div class='body'>
    <div class='container'>
        <?php
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
                ";
            }
            ?>
    </div>
</div>
<?php include 'footer.php'; ?>