<?php
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $ex){
    echo("Internal error, please contact support");
    error_log("pdo.php, SQL error=".$ex->getMessage());
    return;
}