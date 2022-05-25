<?php
include_once('pdo.php');

if (!isset($_SESSION['user_id']))
    die('ACCESS DENIED');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return;
    }
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['summary']) < 1) {
        $_SESSION['error'] = 'All fields are required required';
        header("Location: add.php");
        return;
    } else if (!strpos($_POST['email'], '@')) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: add.php");
    } else {
        $stmt = $pdo->prepare('INSERT INTO profile (user_id, first_name, last_name, email, headline, summary) VALUES ( :uid, :fn, :ln, :em, :he, :su)');
        $stmt->execute(array(
                ':uid' => $_SESSION['user_id'],
                ':fn' => $_POST['first_name'],
                ':ln' => $_POST['last_name'],
                ':em' => $_POST['email'],
                ':he' => $_POST['headline'],
                ':su' => $_POST['summary'])
        );
        $_SESSION['success'] = "Profile added";
        header("Location: index.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Charilaos Papamatthaiou's - dc3c3c4e - Add Page</title>
</head>
<body>
<div class="container">
    <h1>Adding Profile for UMSI</h1>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>First Name:
            <label for="first_name">
                <input type="text" name="first_name" size="60">
            </label></p>
        <p>Last Name:
            <label>
                <input type="text" name="last_name" size="60">
            </label></p>
        <p>Email:
            <label>
                <input type="text" name="email" size="30">
            </label></p>
        <p>Headline:<br>
            <label>
                <input type="text" name="headline" size="80">
            </label></p>
        <p>Summary:<br>
            <label>
                <textarea name="summary" rows="8" cols="80"></textarea>
            </label>
        </p><p>
            <input type="submit" value="Add">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>
</div>
</body>
</html>