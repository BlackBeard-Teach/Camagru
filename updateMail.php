<?php session_start();

include('config/database.php');

$_SESSION['y'] = null;
$oldMail = $_POST['oldMail'];
$newMail = $_POST['newMail'];

if(isset($_POST['UpdateMail']))
{
    $mail =  $_SESSION['mail'];
   
    try{
        $conn = new PDO($DSN_dbname, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = $conn->prepare("SELECT * FROM users WHERE Email = ?");
        $pdo->execute($mail);
        
    }catch (PDOexception $e){
        $_SESSION['y'] = "Connection Error";
        header("Location: editMail.php");
    }
    $row = $pdo->fetch(PDO::FETCH_ASSOC);
    $email = $row['Email'];
    if ($mail == $oldMail)
    {
        $conn = new PDO($DSN_dbname, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = $conn->prepare("UPDATE users SET Email = ? WHERE Email = ?");
        $pdo->execute(array($newMail, $mail));
        $_SESSION['y'] = "Email succesfully changed";
        header("Location: editMail.php");

    }else
    {
    $_SESSION['y'] = "User not found $oldMail | | $newMail  $mail" ;
    header("Location: editMail.php");
    }
}
else
{
    $_SESSION['y'] = "Something went wrong we working on it";
    header("Location: editMail.php");
}
