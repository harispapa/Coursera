<?php
include_once('pdo.php');
include_once('functions.php');

checkForUserLogInStatus();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return;
    }
    $positionVal = validatePos();
    if (is_string($positionVal)){
        header("Location: add.php");
        $_SESSION['error'] = $positionVal;
        return;
    }
    else {
        $proNewId = postProfileDB();
        postPositionDB($proNewId);
        $eRank=1;
        for($i=1; $i<=9; $i++) {
            if ( ! isset($_POST['edu_year'.$i]) ) continue;
            if ( ! isset($_POST['edu_school'.$i]) ) continue;
            $instituteId = postInstitutionDB($_POST['edu_school'.$i]);
            postEducationDB($instituteId,$proNewId, $eRank, $_POST['edu_year'.$i]);
            $eRank++;
        }
        $_SESSION['success'] = "Profile added";
        header("Location: index.php");
    }
    return;
}
$siteTitle = "Charilaos Papamatthaiou's - 82577bed - Add Page";
$h1 = "<h1>Adding Profile for UMSI</h1>";
$profile = [];
include_once ("add_form.html");
?>