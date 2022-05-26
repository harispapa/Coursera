<?php
include_once('pdo.php');
include_once('functions.php');

checkForUserLogInStatus();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return;
    }
    $isFormOk= checkAddEditFormFields();
    $positionVal = validatePos();
    if (!$isFormOk || is_string($positionVal)){
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
        $profile_id = $pdo->lastInsertId();
        $rank=0;
        for($i=1; $i<=9; $i++) {
            if(isset($_POST['year'.$i]) && isset($_POST['desc'.$i])){
                $stmt = $pdo->prepare('INSERT INTO position (profile_id, `rank`, year, description) VALUES ( :pid, :rk, :yr, :dc)');
                $stmt->execute(array(
                        ':pid' => $profile_id,
                        ':rk' => $rank,
                        ':yr' => $_POST['year'.$i],
                        ':dc' => $_POST['desc'.$i])
                );
                $rank++;
            }
        }
        $_SESSION['success'] = "Profile added";
        header("Location: index.php");
    }
    return;
}
include_once ("add_form.html");
?>