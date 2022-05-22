<?php // Do not put any HTML above this line

include_once('pdo.php');
require_once "bootstrap.php";

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  )
    die('Name parameter missing');

if (isset($_POST['logout'])){
    header("Location: index.php");
    return;
}

$failure = false;  // If we have no POST data
if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']))
    if ( strlen($_POST['make']) < 1 )
        $failure = 'Make is required';
    else if ( !is_numeric($_POST['year']) || !is_numeric($_POST['mileage']))
        $failure = 'Mileage and year must be numeric';
    else{
        $stmt = $pdo->prepare("INSERT INTO autos(make,year,mileage) VALUES (:mk,:yr,:mi);" );
        $stmt->execute(array('mk' => $_POST['make'],'yr' => $_POST['year'], 'mi' => $_POST['mileage']));
        $success = "Record inserted";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charilaos Papamatthaiou - 456bb5fa - Autos.php</title>
    <?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?php echo $_REQUEST['name']; ?></h1>
    <?php if ( $failure !== false ) echo('<p style="color: red;">'.htmlentities($failure)."</p>\n"); ?>
    <?php if ( isset($success) ) echo('<p style="color: green;">'.htmlentities($success)."</p>\n"); ?>
    <form method="post">
        <p>Make : <input type="text" name="make" id="make"></p>
        <p>Year : <input type="text" name="year" id="year"></p>
        <p>Mileage : <input type="text" name="mileage" id="mileage"></p>
        <input type="submit" name="add" value="Add"> <input type="submit" name="logout" value="Logout">
    </form>
</div>
<div class="container">
    <h1>Automobiles</h1>
    <?php
        $autos = $pdo->query("SELECT * FROM autos ORDER BY make" );
        echo '<ul>';
        foreach ($autos as $auto)
            echo "<li>".htmlentities($auto['year'])." ".htmlentities($auto['make'])." / ".htmlentities($auto['mileage'])."</li>";
        echo '</ul>';

    ?>
</div>
</body>
</html>