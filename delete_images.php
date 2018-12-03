<?php
session_start();

    $uid = $_SESSION['username'];
    require_once 'Config/database.php';

    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("SELECT * FROM images WHERE image_id=:image_id AND user=:user");
        $sql->execute(array(':image_id' => $_GET['image_id'], ':user' => $uid));


        $sql = $dbh->prepare("DELETE FROM `likes` WHERE image_id=:image_id");
        $sql->execute(array(':image_id' => $_GET['image_id']));

        $sql = $dbh->prepare("DELETE FROM comments WHERE image_id=:image_id");
        $sql->execute(array(':image_id' => $_GET['image_id']));


        $sql = $dbh->prepare("DELETE FROM images WHERE image_id=:image_id AND user=:user");
        $sql->execute(array(':image_id' => $_GET['image_id'], ':user' => $uid));
        header("Location: home.php");
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
