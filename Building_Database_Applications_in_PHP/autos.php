<?php // Do not put any HTML above this line

include_once('pdo.php');
require_once "bootstrap.php";

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}
else{
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name =:name");
    $stmt->execute(array(':name' => $_GET['name'] ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row === FALSE) {
        error_log("Someone tried to access autos.php " . $_GET['name']);
        header("Location : index.php");
        exit();
    }
    else $user = $row;
}

if (isset($_POST['logout'])){
    header("Location: index.php");
    exit();
}

$failure = false;  // If we have no POST data
if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if ( strlen($_POST['make']) < 1 )
        $failure = 'Make is required';
    else if ( !is_numeric($_POST['year']) || !is_numeric($_POST['mileage']))
        $failure = 'Mileage and year must be numeric';
    else{
        $stmt = $pdo->prepare("INSERT INTO autos(make,year,mileage) VALUES (:mk,:yr,:mi);" );
        $stmt->execute(array('mk' => $_POST['make'],'yr' => $_POST['year'], 'mi' => $_POST['mileage']));
        $success = "Record inserted";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charilaos Papamatthaiou Autos.php</title>
    <?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?php echo $user['email']; ?></h1>
    <?php if ( $failure !== false ) echo('<p style="color: red;">'.htmlentities($failure)."</p>\n"); ?>
    <?php if ( isset($success) ) echo('<p style="color: green;">'.htmlentities($success)."</p>\n"); ?>
    <form action="" method="post">
        <label for="make">Make : <input type="text" name="make" id="make"></label><br>
        <label for="year">Year : <input type="text" name="year" id="year"></label><br>
        <label for="mileage">Mileage : <input type="text" name="mileage" id="mileage"></label><br>
        <input type="submit" name="submit" value="Add"> <input type="submit" name="logout" value="Logout">
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