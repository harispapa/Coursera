<?php
include_once('pdo.php');

if (!isset($_SESSION['user_id']))
    die('ACCESS DENIED');

if (isset($_GET['profile_id']) && is_numeric($_GET['profile_id'])) {
    $stmt = $pdo->prepare('SELECT * FROM profile WHERE profile_id=:pid and user_id=:uid');
    $stmt->execute(array(':uid' => $_SESSION['user_id'], ':pid' => $_GET['profile_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return;
    }
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM profile where profile_id=:pid");
        $stmt->execute(["pid" => $_POST['profile_id']]);
        $_SESSION['success'] = "Record deleted";
        header("Location: index.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Charilaos Papamatthaiou's - dc3c3c4e - Delete Page</title>
</head>
<body>
<div class="container">
    <h1>Deleting Profile</h1>
    <form action="delete.php" method="post">
        <p>First Name:<?php echo $row['first_name']; ?></p>
        <p>Last Name:<?php echo $row['last_name']; ?></p>
        <input type="hidden" name="profile_id" value="<?php echo $_GET['profile_id'];  ?>">
        <input type="submit"  name="delete" value="Delete">
        <input type="submit" name="cancel" value="Cancel">
    </form>
</div>
</body>
</html>