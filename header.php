<!DOCTYPE html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'conn.php';
?>

<html>
<head>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <link rel='stylesheet' type='text/css' href='css/style.css'>
    <link rel='icon' type='image/png' href='img/favicon2.ico'>
    <title>TestQuest</title>
</head>
<body>
    <header>
        <nav class='navbar navbar-expand-sm bg-dark navbar-dark fixed-top' id='nav'>
            <a class='navbar-brand' href='#'><img src='img/logo.png' alt='logo' id='logo'></a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#collapsiblenavbar'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='collapsiblenavbar'>
                <ul class='navbar-nav mr-auto'>
                    <li class='nav-item'><a class='nav-link' href='index.php'>Home</a></li>
                    <li class='nav-item'><a class='nav-link' href='about.php'>About</a></li>
                    <?php
                    if(isset($_SESSION['loggedin'])) {
                        echo "
                        <li class='nav-item'><a class='nav-link' href='quizzes.php'>Quizzes</a></li>                        
                        ";
                    }
                    ?>
                </ul>
                <ul class='navbar-nav'>
                    <?php
                    if(isset($_SESSION['loggedin'])) {
                        $user = $_SESSION['username'];
                        echo "
                        <li class='nav-item'><a class='nav-link' href='#'>$user</a></li>
                        <li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>
                        ";
                    } else {
                        echo "
                        <li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>
                        <li class='nav-item'><a class='nav-link' href='signup.php'>Sign Up</a></li>
                        ";
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>