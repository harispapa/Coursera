<?php
include_once ('pdo.php');

$term = $_GET['term'];
error_log('Looking up typehead term:'.$term);

$stmt = $pdo->prepare('SELECT name FROM institution WHERE name LIKE :prefix');
$stmt->execute(array(':prefix' => $term.'%'));

$res = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC))
    $res[]  = $row['name'];

echo json_encode($res, JSON_PRETTY_PRINT);