<?php
session_start();

include_once '../functions/validation.php';

// retrieve values
$mail = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$password1 = $_POST['password'];

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

if (strlen($username) > 50 || strlen($username) < 4) {
  $_SESSION['error'] = "Username should be between 4 and 50 characters";
  header("Location: ../signup.php");
  return;
}

if (strlen($password) < 8) {
  $_SESSION['error'] = "Password too short! Should be at least 8 characters long";
  header("Location: ../signup.php");
  return;
}

if ($password != $password1)
{
    $_SESSION['error'] = "Password do not match";
    header("Location: ../signup.php");
}

if (!preg_match("#[0-9]+#", $password))
{
    $_SESSION['error'] = "Password must include at least one number!";
    header("Location: ../signup.php");
    return;
}

if (!preg_match("#[a-zA-Z]+#", $password))
{
    $_SESSION['error'] = "Password must include at least onr letter!";
    header("Location: ../signup.php");
    return;
}

if( !preg_match("#\W+#", $password) ) {
    $_SESSION['error'] = "Password must include at least one symbol!";
    header("Location: ../signup.php");
    return;
}

if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)){
    echo "Your password is strong.";
} else {
    $_SESSION['error'] = "Your password is not secure.";
}

if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $_SESSION['error'] = "Username must have letters and digits only";
    header("Location: ../signup.php");
    return;
}

$url = $_SERVER['HTTP_HOST'] . str_replace("/forms/validation.php", "", $_SERVER['REQUEST_URI']);

signup($mail, $username, $password, $url);

header("Location: ../signup.php");
?>

