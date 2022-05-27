<?php
include_once('pdo.php');
include_once('functions.php');
checkForUserLogInStatus();
if (isset($_GET['profile_id']) && is_numeric($_GET['profile_id'])) {
    $profile = getProfileById($_GET['profile_id']);
    $positions = getPositionsById($_GET['profile_id']);
    $educations = getEducationById($_GET['profile_id']);
    $schools = getInstitutionsById($_GET['profile_id']);
}
include_once ('view.html');
?>