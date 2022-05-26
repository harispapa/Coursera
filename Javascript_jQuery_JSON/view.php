<?php
include_once('pdo.php');
include_once('functions.php');
checkForUserLogInStatus();
if (isset($_GET['profile_id']) && is_numeric($_GET['profile_id'])) {
    $stmt = $pdo->prepare('SELECT * FROM profile WHERE profile_id=:pid and user_id=:uid');
    $stmt->execute(array(':uid' => $_SESSION['user_id'], ':pid' => $_GET['profile_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
include_once ('view.html');
?>