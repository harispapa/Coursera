<?php

include_once('pdo.php');
require_once "bootstrap.php";
session_start();

if ( ! isset($_SESSION['name']) )
die('ACCESS DENIED');

if (isset($_GET['autos_id']) && is_numeric($_GET['autos_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM autos where autos_id=:id");
    $stmt->execute([ "id" => $_GET['autos_id']]);
    $auto = $stmt->fetch();
    $make = htmlentities($auto['make']) ?? '';
}

if (isset($_POST['delete'])){
    $stmt = $pdo->prepare("DELETE FROM autos where autos_id=:id");
    $stmt->execute([ "id" => $_GET['autos_id']]);
    $_SESSION['success'] = "Record deleted";
    header("Location: view.php");
    return;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charilaos Papamatthaiou - dc5675aa - Delete.php</title>
</head>
<body>
<div class="container">
    <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    echo " <p>Confirm: Deleting ".$make."</p>";
    ?>
    <form method="post">
        <input type="submit" name="delete" value="Delete"> <a href="view.php"> Cancel</a>
    </form>
</div>
</body>
</html>
