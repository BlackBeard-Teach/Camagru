<?php
session_start();
include('config/database.php');


$_SESSION['er'] = null;
$user = $_POST['Username'];
$pwd = $_POST['Password'];
$rem = $_POST['remember'];
$pass = hash("Whirlpool", $pwd);

try{
    $conn = new PDO($DSN_dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("SELECT Username, Passwd FROM users WHERE Username=? AND Passwd = ? AND varified = 1");
    $pdo->execute(array($user, $pass));
    $found= $pdo->rowCount();
    $row = $pdo->fetch(PDO::FETCH_ASSOC);
    
    echo $found;
    echo $pass;

    if ($found == 1)
    {
        $_SESSION['username'] = $row['Username'];
        $_SESSION['email'] = $row['Email'];
        header('Location: home.php');
        exit;
    }
    else
    {
        $_SESSION['er'] = "User not found or wrong password";
       header('Location: login.php');
    exit();
    } 
}
catch (PDOEXCEPTION $e)
{
  echo $e; // $_SESSION['error'] = "One niqqa bring 2 niqqa";
  
}

header('Location: login.php');
$conn = NULL;
?>


