<?php
include_once('pdo.php');
require_once "bootstrap.php";

session_start();
if ( ! isset($_SESSION['name']) )
    die('Not logged in');

if (isset($_POST['cancel'])){
    header("Location: view.php");
    return;
}

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']))
    if ( strlen($_POST['make']) < 1 ){
        $_SESSION['error'] = 'Make is required';
        header("Location: add.php");
        return;
    }
    else if ( !is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
        $_SESSION['error'] = 'Mileage and year must be numeric';
        header("Location: add.php");
        return;
    }
    else{
        $stmt = $pdo->prepare("INSERT INTO autos(make,year,mileage) VALUES (:mk,:yr,:mi);" );
        $stmt->execute(array('mk' => $_POST['make'],'yr' => $_POST['year'], 'mi' => $_POST['mileage']));
        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charilaos Papamatthaiou - 05fc1671 - Autos.php</title>
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?php echo $_SESSION['name']; ?></h1>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>Make: <input type="text" name="make" id="make" size="60"></p>
        <p>Year: <input type="text" name="year" id="year"></p>
        <p>Mileage: <input type="text" name="mileage" id="mileage"></p>
        <input type="submit" name="add" value="Add"> <input type="submit" name="cancel" value="Cancel">
    </form>
</div>
</body>
</html>