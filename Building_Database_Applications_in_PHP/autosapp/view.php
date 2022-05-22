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
    <title>Charilaos Papamatthaiou - dc5675aa - View Page</title>
    <?php require_once "bootstrap.php"; ?>
    <style>
        th, td {
            padding : 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Welcome to the Automobiles Database</h2>
    <?php
    if ( isset($_SESSION['success']) ) {
        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    }
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    $autos = $pdo->query("SELECT * FROM autos ORDER BY make" );
    var_dump($autos);
    if (!empty($autos) ){
        echo '<table border="1"><thead>';
        echo "<tr>
                  <th><strong>Make</strong></th>
                  <th><strong>Model</strong></th>
                  <th><strong>Year</strong></th>
                  <th><strong>Mileage</strong></th>
                  <th><strong>Action</strong></th>
                </tr>";
        echo "</thead><tbody>";
        foreach ($autos as $auto) {
            echo '<tr>';
            echo '<td>' . htmlentities($auto['make']) . '</td>';
            echo '<td>' . htmlentities($auto['model']) . '</td>';
            echo '<td>' . htmlentities($auto['year']) . '</td>';
            echo '<td>' . htmlentities($auto['mileage']) . '</td>';
            echo '<td><a href="edit.php?autos_id='.$auto['autos_id'].'">Edit </a> / <a href="delete.php?autos_id=' . $auto['autos_id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        echo "</tbody></table>";
    } else
        echo "<p>No rows found</p>";
    ?>

    <p><a href="add.php">Add New Entry</a></p>
    <p> <a href="logout.php">Logout</a></p>
</div>
</body>
</html>
