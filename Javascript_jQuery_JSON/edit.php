<?php
include_once('pdo.php');
include_once ('functions.php');

$editPage = true;
checkForUserLogInStatus();
if (isset($_GET['profile_id']) && is_numeric($_GET['profile_id'])) {
    $stmt = $pdo->prepare('SELECT * FROM profile WHERE profile_id=:pid and user_id=:uid');
    $stmt->execute(array(':uid' => $_SESSION['user_id'], ':pid' => $_GET['profile_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['cancel'])){
        header("Location: index.php");
        return;
    }
    $isFormOk= checkAddEditFormFields();
    if (!$isFormOk)
        header("Location: edit.php?profile_id=".$_GET['profile_id']);
    else{
        $stmt = $pdo->prepare('UPDATE profile SET user_id =:uid, first_name =:fn, last_name=:ln, email=:em, headline=:he, summary=:su WHERE user_id=:uid and profile_id=:pid');
        $stmt->execute(array(
                ':uid' => $_SESSION['user_id'],
                ':pid' => $_GET['profile_id'],
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
        $_SESSION['success'] = "Record updated";
        header("Location: index.php");
    }
    return;
}

include_once('add_form.html');
?>