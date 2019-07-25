<?php include 'header.php'; ?>
<div class='body'>
    <div class='container'>
        <?php
        // If user is coming from quizzes.php, change global quiz variable
        if(isset($_GET['flashcards'])) {
            $_SESSION['current_quiz_id'] = mysqli_real_escape_string($con, $_GET['quiz_id']);
            $_SESSION['current_quiz_name'] = mysqli_real_escape_string($con, $_GET['quiz_name']);
        }
        
        $quiz_id = $_SESSION['current_quiz_id'];
        $quiz_name = $_SESSION['current_quiz_name'];

        echo "
        <div class='row'>
            <div class='col-sm-8'>
                <h2>$quiz_name</h2>
            </div>
            <div class='col-sm-2'>
                <form action='editQuiz.php' method='GET' class='inline'>
                    <input type='hidden' value='$quiz_id' name='quiz_id'>
                    <input type='hidden' value='$quiz_name' name='quiz_name'>
                    <button type='submit' class='btn btn-primary btn-block'>Edit</button>
                </form>
            </div>
            <div class='col-sm-2'>
                <form action='editQuizHandler.php' method='POST' class='inline'>
                    <input type='hidden' value='$quiz_id' name='quiz_id'>
                    <input type='hidden' value='$quiz_name' name='quiz_name'>
                    <button type='submit' name='deleteQuiz' value='true' class='btn btn-danger btn-block'>Delete</button>
                </form>
            </div>
        </div>
        <br>
        ";

        
        echo "
        <form method='GET' action='flashcards.php'>
            <button type='submit' class='btn btn-primary' name='view' value='true'>View </button>
            <button type='submit' class='btn btn-primary' name='study' value='true'>Study </button>
            <button type='submit' class='btn btn-primary' name='test' value='true'>Test</button>
        </form>
        <br>
        ";

        $sql = "SELECT * FROM flashcards WHERE `quiz_id` = '$quiz_id' ORDER BY RAND()";
        $result = mysqli_query($con, $sql);
        $num_rows = mysqli_num_rows($result);

        if($num_rows < 1) {
            echo "<i>These are not the flashcards you are looking for.</i>";
        }
        
        else if(isset($_GET['study'])) {
            while($row = mysqli_fetch_array($result)) {
                $flashcard_id = htmlspecialchars($row['flashcard_id'], ENT_QUOTES);
                $question = htmlspecialchars($row['question'], ENT_QUOTES);
                $answer = htmlspecialchars($row['answer'], ENT_QUOTES);

                echo "
                <script>
                function studyFlashcards$flashcard_id() {
                    var x = document.getElementById('$flashcard_id');
                    if (x.style.display === 'none') {
                        x.style.display = 'block';
                    } else {
                        x.style.display = 'none';
                    }
                }
                </script>
                ";

                echo "
                <div class='row'>
                    <div class='col-sm-6'>
                        <button onclick='studyFlashcards$flashcard_id()' class='btn btn-light btn-block jumbotron' align='center'>$question</button>
                    </div>
                    <div class='col-sm-6'>
                        <div class='jumbotron' id='$flashcard_id' align='center' style='display: none;'>$answer</div>
                    </div>
                </div>
                ";
            }
        }

        else if(isset($_GET['test'])) {
            while($row = mysqli_fetch_array($result)) {
                $flashcard_id = htmlspecialchars($row['flashcard_id'], ENT_QUOTES);
                $question = htmlspecialchars($row['question'], ENT_QUOTES);
                $answer = htmlspecialchars($row['answer'], ENT_QUOTES);

    
                echo "
                <script>
                function testFlashcards$flashcard_id() {
                    var x = document.getElementById('$flashcard_id').value;
                    if (x === '$answer') {
                        // alert('Yay');
                        $('#check$flashcard_id').addClass('btn-success');
                        $('#check$flashcard_id').removeClass('btn-danger');
                    } else {
                        // alert('Booo. Or the answer has quotation marks');
                        $('#check$flashcard_id').addClass('btn-danger');
                        $('#check$flashcard_id').removeClass('btn-success');
                    }
                }
                </script>
                ";

                echo "
                <br>
                <div class='row'>
                    <div class='col-sm-5'>
                        <div align='right'>$question</div>
                    </div>
                    <div class='col-sm-4'>
                        <textarea id='$flashcard_id' rows='1' class='form-control expanding' name='answer' placeholder='Enter answer' required></textarea>
                    </div>
                    <div class='col-sm-3'>
                        <div class='btn-group btn-block'>
                            <button onclick='testFlashcards$flashcard_id()' id='check$flashcard_id' value='true' class='btn btn-primary'>Check</button>
                        </div>
                    </div>
                </div>
                ";
            }
        }

        else {
            while($row = mysqli_fetch_array($result)) {
                $flashcard_id = htmlspecialchars($row['flashcard_id'], ENT_QUOTES);
                $question = htmlspecialchars($row['question'], ENT_QUOTES);
                $answer = htmlspecialchars($row['answer'], ENT_QUOTES);

                echo "
                <div class='row'>
                    <div class='col-sm-6'>
                        <div class='jumbotron' align='center'>$question</div>
                    </div>
                    <div class='col-sm-6'>
                        <div class='jumbotron' align='center'>$answer</div>
                    </div>
                </div>
                ";
            }
        }
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>