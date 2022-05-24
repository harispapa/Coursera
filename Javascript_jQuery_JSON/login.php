<?php
include_once('pdo.php');

$salt = 'XyZzy12*_';
if (isset($_POST['cancel'])){
    // Redirect the browser to index.php
    header("Location: index.php");
    return;
}
if (isset($_POST['email']) && isset($_POST['pass'])) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
        $_SESSION['error'] = "Email and password are required";
        header("Location: login.php");
    }
    else if (!strpos($_POST['email'],'@')) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
    }
    else {
        $check = hash('md5', $salt.$_POST['pass']);
        $stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
        $stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row !== false) {
            // Redirect the browser to view.php
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_id'] = $row['user_id'];
            // Redirect the browser to index.php
            header("Location: index.php");
        } else {
            error_log("Login fail ".$_POST['email']." $check");
            $_SESSION['error']  = "Incorrect password";
            header("Location: login.php");
        }
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Charilaos Papamatthaiou's - 05fc1671 - Login Page</title>
</head>
<body>
<div class="container">
    <h1>Please Log In</h1>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post" action="login.php">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br/>
        <label for="id_1723">Password</label>
        <input type="text" name="pass" id="id_1723"><br/>
        <input type="submit" value="Log In" onclick="return doValidate();"> <a href="index.php">Cancel</a>
        <p></p>
    </form>
    <p>For a password hint, view source and find a password hint in the HTML comments.
        <!-- Hint: The password is the three character name of the programming language used in this class
        (all lower case) followed by 123. -->
    </p>
</div>
<script>
    let myForm = document.querySelector('form');
    let email  = document.querySelector('#email');
    let pass   = document.querySelector('#id_1723');
    function doValidate(){
        console.log('Validating...');
        try{
            console.log('Validating... email:'+email.value+' pass:'+ pass.value);
            if (email.value == null || email.value === '' || pass.value == null || pass.value === ''){
                alert("Both fields must be filled out");
                return false;
            }
            else if (email.value.indexOf('@') !== -1) {
                myForm.submit();
            } else {
                alert("Invalid email address");
                return false;
            }
        }
        catch (e) {
            return false;
        }
        return false;
    }
</script>
</body>