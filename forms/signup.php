<?php
session_start();

include_once '../functions/signup.php';

// retrieve values
$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['error'] = null;

if ($mail == "" || $mail == null || $username == "" || $username == null || $password == "" || $password == null) {
  $_SESSION['error'] = "All Fields are required";
  header("Location: ../signup.php");
  return;
}

if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error'] = "You need to enter a valid email";
  header("Location: ../signup.php");
  return;
}

if (strlen($username) > 50 || strlen($username) < 3) {
  $_SESSION['error'] = "Username should be between 3 and 50 characters";
  header("Location: ../signup.php");
  return;
}

if (strlen($password) < 3) {
  $_SESSION['error'] = "Password should be between 3 and 255 characters";
  header("Location: ../signup.php");
  return;
}

if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $_SESSION['error'] = "Username must have letters and digits only";
    header("Location: ../signup.php");
    return;
}

$url = $_SERVER['HTTP_HOST'] . str_replace("/forms/signup.php", "", $_SERVER['REQUEST_URI']);

signup($mail, $username, $password, $url);

header("Location: ../signup.php");
?>
