<?php
include_once('pdo.php');
include_once ('functions.php');

$editPage = true;
$siteTitle = "Charilaos Papamatthaiou's - 82577bed - Edit Page";
$h1 = "<h1>Editing Profile for UMSI</h1>";

checkForUserLogInStatus();
if (isset($_GET['profile_id']) && is_numeric($_GET['profile_id'])) {
    $profile      = getProfileById($_GET['profile_id']);
    $positions    = getPositionsById($_GET['profile_id']);
    $educations   = getEducationById($_GET['profile_id']);
    $institutions = getInstitutionsById($_GET['profile_id']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['cancel'])){
        header("Location: index.php");
        return;
    }
    $positionVal = validatePos();
    if (is_string($positionVal)){
        header("Location: edit.php?profile_id=".$_GET['profile_id']);
        $_SESSION['error'] = $positionVal;
        return;
    }
    else{
        $profileId = updateProfilesByIds();
        deleteOldEducations($_GET['profile_id']);
        deleteOldPosition($_GET['profile_id']);
        postPositionDB($_GET['profile_id']);
        $eRank=1;
        for($i=1; $i<=9; $i++) {
            if ( ! isset($_POST['edu_year'.$i]) ) continue;
            if ( ! isset($_POST['edu_school'.$i]) ) continue;
            $instituteId = postInstitutionDB($_POST['edu_school'.$i]);
            postEducationDB($instituteId,$_GET['profile_id'], $eRank, $_POST['edu_year'.$i]);
            $eRank++;
        }
        $_SESSION['success'] = "Record updated";
        header("Location: index.php");
    }
    return;
}
include_once('add_form.html');
?>