<!DOCTYPE html>
<html lang="en">
<?php
$error = false;
$md5 = false;
$pin = $_GET['pin'] ?? '';
if (strlen($pin) != 4 || !isset($pin) )
    $error = "Input must be exactly four characters.";
else
    if (is_numeric($pin))
        $md5 = hash('md5', $pin);
    else
        $error = "Input must be numeric";
?>
<!DOCTYPE html>
<head>
    <title>Charis Papamatthaiou PIN Code</title>
</head>
<body style="font-family: sans-serif">
<h1>MD5 PIN Maker</h1>
<?php
if ($error !== false) {
    print '<p style="color:red">';
    print htmlentities($error);
    print "</p>\n";
}
if ($md5 !== false)
    print "<p>MD5 value: " . htmlentities($md5) . "</p>";
?>
<p>Please enter a four-number key for encoding.</p>
<form>
    <label for="name">
        <input type="text" name="pin" value="<?= htmlentities($pin) ?>"/>
    </label>
    <input type="submit" value="Compute MD5 for PIN"/>
</form>
<ul>
    <li><a href="makepin.php">Reset this page</a></li>
    <li><a href="index.php">Back to Cracking</a></li>
</ul>
</body>
</html>
