<?php
include_once('pdo.php');
include_once('functions.php');

checkForUserLogInStatus();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return;
    }
    $positionVal = validatePos();
    if (is_string($positionVal)){
        header("Location: add.php");
        $_SESSION['error'] = $positionVal;
        return;
    }
    else {
        $stmt = $pdo->prepare('INSERT INTO profile (user_id, first_name, last_name, email, headline, summary) VALUES ( :uid, :fn, :ln, :em, :he, :su)');
        $stmt->execute(array(
                ':uid' => $_SESSION['user_id'],
                ':fn' => $_POST['first_name'],
                ':ln' => $_POST['last_name'],
                ':em' => $_POST['email'],
                ':he' => $_POST['headline'],
                ':su' => $_POST['summary'])
        );
        $proNewId = $pdo->lastInsertId();
        postPositionDB($proNewId);
        $instituteNewId= postInstitutionDB();
        postEducationDB($instituteNewId,$proNewId);
        $_SESSION['success'] = "Profile added";
        header("Location: index.php");
    }
    return;
}
include_once ("add_form.html");
?>