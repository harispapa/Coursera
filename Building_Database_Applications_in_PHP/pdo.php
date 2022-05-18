<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'fred', 'zap');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $ex){
    echo("Internal error, please contact support");
    error_log("pdo.php, SQL error=".$ex->getMessage());
    return;
}