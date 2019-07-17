<?php
include 'header.php';

$user = mysqli_real_escape_string($con, $_POST['username']);
$pass = mysqli_real_escape_string($con, $_POST['password']);

$sql = "SELECT * FROM user WHERE `user_name` = '$user' AND `password` = '$pass'";

$result = mysqli_query($con, $sql);
if($row = mysqli_fetch_array($result)) {
    $_SESSION['username'] = $user;
    $_SESSION['loggedin'] = true;
    header('Location: index.php');
} else {
    $_SESSION['login_error'] = true;
    header('Location: login.php');
}
?>