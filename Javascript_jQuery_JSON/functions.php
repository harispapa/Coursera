<?php
include_once ('pdo.php');

function displaySessionsErrors(): void{
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    if ( isset($_SESSION['success']) ) {
        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    }
}

function checkForUserLogInStatus(): void{
    if (!isset($_SESSION['user_id']))
        die('ACCESS DENIED');
}

function validatePos(): bool|string{
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['headline']) < 1 ||
        strlen($_POST['email']) < 1 || strlen($_POST['summary']) < 1)
        return 'All fields are required';
    else if (!strpos($_POST['email'], '@'))
        return "Email must have an at-sign (@)";

    for($i=1; $i<=9; $i++) {
        if ( ! isset($_POST['year'.$i]) ) continue;
        if ( ! isset($_POST['desc'.$i]) ) continue;

        $year = $_POST['year'.$i];
        $desc = $_POST['desc'.$i];

        if ( strlen($year) == 0 || strlen($desc) == 0 ) {
            return "All fields are required";
        }

        if ( ! is_numeric($year) ) {
            return "Position year must be numeric";
        }
    }
    return true;
}

function postPositionDB($profile_id): void{
    global $pdo;
    $rank=1;
    for($i=1; $i<=9; $i++) {
        if ( ! isset($_POST['year'.$i]) ) continue;
        if ( ! isset($_POST['desc'.$i]) ) continue;
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
}

function deleteOldPosition($profile_id){
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM position WHERE profile_id=:pid');
    $stmt->execute(array(':pid' => $profile_id));
    return $stmt->rowCount();
}