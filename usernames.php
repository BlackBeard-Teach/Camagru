<?php session_start();

include('config/database.php');

$_SESSION['t'] = null;
$newUser = $_POST['newUsername'];
$name = $_POST['oldUsername'];

if (isset($_POST['UpdateUser']))
{
 $oldUser = $_SESSION['username'];

 try{
     $conn = new PDO($DSN_dbname, $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $pdo = $conn->prepare("SELECT * FROM users WHERE Username = ?");
     $pdo->execute($oldUser);

 }catch(PDOException $e){
    $_SESSION['t'] = "Connection Error";
    header("Location: changUsername.php");
}

 $row = $pdo->fetch(PDO::FETCH_ASSOC);
 $user = $row['Username'];

 if ($name == $oldUser)
 {
     try{
        $conn = new PDO($DSN_dbname, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = $conn->prepare("UPDATE users SET Username = ? WHERE Username = ?");
        $pdo->execute(array($newUser, $oldUser));
        $_SESSION['t'] = "Username succesfully changed";
        header("Location: editUsername.php");
     }catch(PDOException $e){
    $_SESSION['t'] = "Connection errors";
    header("Location: editUsername.php");
}
 }
else{
    $_SESSION['t'] = "Usernames don't match ";
    header("Location: editUsername.php");
    }
}
