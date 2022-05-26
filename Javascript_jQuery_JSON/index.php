<?php
include_once('pdo.php');
include_once ('functions.php');

$userLoggedIn = isset($_SESSION['user_id']) ?? false;
$stmt = $pdo->query('SELECT * FROM profile;');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charilaos Papamatthaiou - 2a0e8414 - Resume Registry</title>
    <?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h1>Chuck Severance's Resume Registry</h1>
    <?php displaySessionsErrors();?>
    <?php if ($userLoggedIn) { ?>
    <p><a href="logout.php">Logout</a></p>
    <table border="1" width="80%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Headline</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($rows as $profile){
                    echo '<tr><td><a href="view.php?profile_id='.$profile['profile_id'].'">'.htmlentities($profile['first_name']).' '. htmlentities($profile['last_name']).'</a></td>';
                    echo '<td>'.htmlentities($profile['headline']).'</td>';
                    echo '<td><a href="edit.php?profile_id='.$profile['profile_id'].'">Edit</a> <a href="delete.php?profile_id='.$profile['profile_id'].'"> Delete</a></td></tr>';
                }
            ?>
        </tbody>
    </table>
    <a href="add.php"> Add New Entry</a>
    <?php } else { ?>
    <p><a href="login.php">Please log in</a></p>
    <?php } ?>
</div>
</body><?php
