<?php
include 'database.php';

// DROP DATABASE
try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DROP DATABASE IF EXISTS`".$DB_NAME."`";
    $dbh->exec($sql);
    echo "Database dropped successfully\n";
} catch (PDOException $e) {
    echo "Unexpected error \n".$e->getMessage()."\n";
}
