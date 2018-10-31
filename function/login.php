<?php

function log_user($userMail, $password) {
  include_once '../config/database.php';
    $DB_NAME = "camagru";
    $DB_DSN = "mysql:host=127.0.0.1;dbname=".$DB_NAME;
    $DB_USER = "root";
    $DB_PASSWORD = "TaksForce141";

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT id, username FROM users WHERE mail=:mail AND password=:password AND verified='Y'");
      $userMail = strtolower($userMail);
      $password = hash("whirlpool", $password);
      $query->execute(array(':mail' => $userMail, ':password' => $password));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      return ($val);
    } catch (PDOException $e) {
      $v['err'] = $e->getMessage();
      return ($v);
    }
}

?>
