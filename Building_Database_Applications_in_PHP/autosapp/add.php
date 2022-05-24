<?php
include_once('pdo.php');
require_once "bootstrap.php";

if ( ! isset($_SESSION['name']) )
    die('ACCESS DENIED');

if (isset($_POST['cancel'])){
    header("Location: view.php");
    return;
}
if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']))
    if ( strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1 ){
        $_SESSION['error'] = 'All fields are required required';
        header("Location: add.php");
        return;
    }
    else if ( !is_numeric($_POST['year'])){
        $_SESSION['error'] = 'Year must be numeric';
        header("Location: add.php");
        return;
    }
        else if (  !is_numeric($_POST['mileage'])){
        $_SESSION['error'] = 'Mileage must be numeric';
        header("Location: add.php");
        return;
    }
    else{
        $stmt = $pdo->prepare("INSERT INTO autos(make, model,year,mileage) VALUES (:mk, :md ,:yr,:mi);" );
        $stmt->execute(array('mk' => $_POST['make'],'md' => $_POST['model'] ,'yr' => $_POST['year'], 'mi' => $_POST['mileage']));
        $_SESSION['success'] = "Record added";
        header("Location: view.php");
        return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charilaos Papamatthaiou - dc5675aa - Autos.php</title>
</head>
<body>
<div class="container">
    <h1>Tracking Automobiles for <?php echo $_SESSION['name']; ?></h1>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>Make: <input type="text" name="make" id="make" size="40"></p>
        <p>Model: <input type="text" name="model" id="model" size="40"></p>
        <p>Year: <input type="text" name="year" id="year" size="10"></p>
        <p>Mileage: <input type="text" name="mileage" id="mileage" size="10"></p>
        <input type="submit" name="add" value="Add"> <input type="submit" name="cancel" value="Cancel">
    </form>
</div>
</body>
</html>