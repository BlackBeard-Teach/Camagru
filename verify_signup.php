<?php
session_start();
function verify_signup($mail, $username, $password, $ip) {
  include_once 'config/database.php';
  //include_once 'signup.php';

  $user = "root";
  $DSN_db = "mysql:host=localhost";
  $db_name = "home";
  $DSN_dbname = "mysql:host=localhost;dbname=$db_name";
  $pwd = "mikasa88";
  
  $mail = strtolower($mail);


  try {
          $dbh = new PDO($DSN_dbname, $user, $pwd);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $pdo= $dbh->prepare("SELECT * FROM users WHERE Username=? OR Email=?");
          $pdo->execute(array($username, $mail));
          $user_exist = $pdo->rowCount();

          if ($user_exist == 1) {
            $_SESSION['error'] = "Username or Email Already taken";
            return ;
          }
          $pass = hash("whirlpool", $password);

          $query= $dbh->prepare("INSERT INTO users (username, Email, Passwd, token) VALUES (?, ?, ?, ?)");
          $token = uniqid(rand(), true);
          $query->execute(array($username,$mail, $pass,$token));

          varification_email($mail, $username, $token, $ip);
          $_SESSION['signup_success'] = true;
          return (0);
          
    
      } catch (PDOException $e) {
          $_SESSION['error'] = "ERROR: ".$e->getMessage();
}
}


function varification_email($mail, $username, $token, $ip)
{
  
$to      = $mail; // Send email to our user
$subject = ' Camagru Signup | Verification'; // Give the email a subject 

$message = '

Hello ' . htmlspecialchars($toUsername). '

Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
Please click this link to activate your account:
http://localhost:8080/camagru/tues/verify.php?token='.$token.'

http://' .$ip.'verify.php?token='.$token.'
 

'; // Our message above including the link
                     
$headers = 'From:camagruteam@camagru.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

}

?>















