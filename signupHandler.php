<?php
include 'header.php';

$fname = mysqli_real_escape_string($con, $_POST['fname']);
$lname = mysqli_real_escape_string($con, $_POST['lname']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$user = mysqli_real_escape_string($con, $_POST['username']);
$pass = mysqli_real_escape_string($con, $_POST['password']);

$sql = "INSERT INTO user (user_name, first_name, last_name, email, password) VALUES ('$user', '$fname', '$lname', '$email', '$pass')";
mysqli_query($con, $sql);

$_SESSION['username'] = $user;
$_SESSION['loggedin'] = true;
header('Location: index.php');
?>