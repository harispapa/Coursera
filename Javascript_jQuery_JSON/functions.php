<?php

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

function checkAddEditFormFields(): bool{
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['summary']) < 1)
        $_SESSION['error'] = 'All fields are required required';
    else if (!strpos($_POST['email'], '@'))
        $_SESSION['error'] = "Email must have an at-sign (@)";
    return true;
}

function checkForUserLogInStatus(): void{
    if (!isset($_SESSION['user_id']))
        die('ACCESS DENIED');
}