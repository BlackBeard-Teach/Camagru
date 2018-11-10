<?php
session_start();
include('config/database.php');
$_SESSION['err'] = null;

$mail = $_POST['Email'];
try{
    $conn = new PDO($DSN_dbname, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("SELECT Username FROM users WHERE Email = ? AND varified = ?");
    $pdo->execute(array($mail, '1'));
    $found = $pdo->rowCount();
    

    if ($found == 1)
    {
        
        $pass = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pass = str_shuffle($pass);
        $pass = substr($pass,0, 8);

        reset_password($mail,$pass);

        $hashed = hash("whirlpool", $pass);
        $pdo = $conn->prepare("UPDATE users SET Passwd = ? WHERE Email = ? AND varified = ?");
        $pdo->execute(array($hashed, $mail, '1'));

        $_SESSION['success'] = "Check Email to change password";
        header('Location: forgot.php');
        
        exit();
    }
    else
    {
        $_SESSION['err'] = "Email incorrect or not found $found";
        header('Location: reset.php');
        exit();
    }

}
catch(PDOEXCEPTION $e)
{
    $_SESSION['err'] = "Something went wrong try again later";
    header('Location: reset.php');
    exit();
}

function reset_password($mail,$pass)
{
 
 $to      = $mail; 
$subject = 'Create New Password'; 

$message = '
 
------------------------
Email: '.$mail.'
Password: '.$pass.'
------------------------ 
Please click this link to login into your account:

http://localhost:8080/camagru/fuk/login.php



'; 
                     
$headers = 'From:camagruteam@camagru.com' . "\r\n";
mail($to, $subject, $message, $headers); 
}
?>