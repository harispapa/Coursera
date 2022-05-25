<?php
include_once('pdo.php');

if (!isset($_SESSION['user_id']))
    die('ACCESS DENIED');

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
    if ( strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['summary']) < 1 ){
        $_SESSION['error'] = 'All fields are required required';
        header("Location: edit.php?profile_id=".$_GET['profile_id']);
        return;
    }
    else if (!strpos($_POST['email'],'@')) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: edit.php?profile_id=".$_GET['profile_id']);
        return;
    }
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
        $_SESSION['success'] = "Record updated";
        header("Location: index.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Charilaos Papamatthaiou's - 05fc1671 - Add Page</title>
</head>
<body>
<div class="container">
    <h1>Editing Profile for UMSI</h1>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>First Name:
            <label for="first_name">
                <input type="text" name="first_name" size="60" value="<?php echo htmlentities($row['first_name']); ?>">
            </label></p>
        <p>Last Name:
            <label>
                <input type="text" name="last_name" size="60" value="<?php echo htmlentities($row['last_name']); ?>">
            </label></p>
        <p>Email:
            <label>
                <input type="text" name="email" size="30" value="<?php echo htmlentities($row['email']); ?>">
            </label></p>
        <p>Headline:<br>
            <label>
                <input type="text" name="headline" size="80" value="<?php echo htmlentities($row['headline']); ?>">
            </label></p>
        <p>Summary:<br>
            <label>
                <textarea name="summary" rows="8" cols="80" ><?php echo htmlentities($row['summary']); ?></textarea>
            </label>
        </p><p>
            <input type="submit" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>
</div>

