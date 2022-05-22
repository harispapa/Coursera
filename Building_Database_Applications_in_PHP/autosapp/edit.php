<?php
include_once('pdo.php');
require_once "bootstrap.php";

session_start();
if ( ! isset($_SESSION['name']) )
    die('ACCESS DENIED');

if (isset($_POST['cancel'])){
    header("Location: view.php");
    return;
}

if (isset($_GET['autos_id']) && is_numeric($_GET['autos_id'])){
    $stmt = $pdo->prepare("SELECT * FROM autos where autos_id=:id" );
    $stmt->execute([ "id" => $_GET['autos_id']]);
    $auto = $stmt->fetch();
    $make = htmlentities($auto['make']) ?? '';
    $model = htmlentities($auto['model']) ?? '';
    $year = htmlentities($auto['year']) ?? '';
    $mileage = htmlentities($auto['mileage']) ?? '';
}
else{
    $_SESSION['error'] = 'Bad value for id';
    header("Location: view.php");
    return;
}

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model']))
    if ( strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1 ){
        $_SESSION['error'] = 'All fields are required required';
        header("Location: edit.php");
        return;
    }
    else if ( !is_numeric($_POST['year'])){
        $_SESSION['error'] = 'Year must be numeric';
        header("Location: edit.php");
        return;
    }
    else if (  !is_numeric($_POST['mileage'])){
        $_SESSION['error'] = 'Mileage must be numeric';
        header("Location: edit.php");
        return;
    }
    else{
        $stmt = $pdo->prepare("UPDATE autos SET make=:mk, model=:md, year=:yr, mileage=:mi WHERE autos_id=:id;" );
        $stmt->execute(array(
                'mk' => $_POST['make'],
                'md' => $_POST['model'],
                'yr' => $_POST['year'],
                'mi' => $_POST['mileage'],
                'id' => $_GET['autos_id']));
        header("Location: view.php");
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charilaos Papamatthaiou - 05fc1671 - edit.php</title>
</head>
<body>
<div class="container">
    <h1>Editing Automobile</h1>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>Make: <input type="text" name="make" id="make" size="40" value="<?php echo $make; ?>"></p>
        <p>Model: <input type="text" name="model" id="model" size="40" value="<?php echo $model;?>"></p>
        <p>Year: <input type="text" name="year" id="year" size="10" value="<?php echo $year; ?>"></p>
        <p>Mileage: <input type="text" name="mileage" id="mileage" size="10" value="<?php echo $mileage; ?>"></p>
        <input type="submit" name="save" value="Save"> <input type="submit" name="cancel" value="Cancel">
    </form>
</div>
</body>
</html>