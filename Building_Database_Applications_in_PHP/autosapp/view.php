<?php // line added to turn on color syntax highlight
include_once('pdo.php');
require_once "bootstrap.php";

session_start();
if ( ! isset($_SESSION['name']) )
  die('Not logged in');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charilaos Papamatthaiou - 456bb5fa - View Page</title>
    <?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?php echo $_SESSION['name'];?></h1>
    <?php
    if ( isset($_SESSION['success']) ) {
        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    }
    ?>
    <h2>Automobiles</h2>
    <?php
        $autos = $pdo->query("SELECT * FROM autos ORDER BY make" );
        echo '<ul>';
        foreach ($autos as $auto)
            echo "<li>".htmlentities($auto['year'])." ".htmlentities($auto['make'])." / ".htmlentities($auto['mileage'])."</li>";
        echo '</ul>';
    ?>
    <p>
        <a href="add.php">Add New</a> |
        <a href="logout.php">Logout</a>
    </p>
</div>
</body>
</html>
