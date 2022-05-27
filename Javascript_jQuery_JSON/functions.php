<?php
include_once ('pdo.php');

function checkForUserLogInStatus(): void{
    if (!isset($_SESSION['user_id']))
        die('ACCESS DENIED');
}
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
function validatePos(): bool|string{
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['headline']) < 1 ||
        strlen($_POST['email']) < 1 || strlen($_POST['summary']) < 1)
        return 'All fields are required';
    else if (!strpos($_POST['email'], '@'))
        return "Email must have an at-sign (@)";

    for($i=1; $i<=9; $i++) {
        if ( ! isset($_POST['year'.$i]) ) continue;
        if ( ! isset($_POST['desc'.$i]) ) continue;

        $year = $_POST['year'.$i];
        $desc = $_POST['desc'.$i];

        if ( strlen($year) == 0 || strlen($desc) == 0 ) {
            return "All fields are required";
        }

        if ( ! is_numeric($year) ) {
            return "Position year must be numeric";
        }
    }

    for($i=1; $i<=9; $i++) {
        if ( ! isset($_POST['edu_year'.$i]) ) continue;
        if ( ! isset($_POST['edu_school'.$i]) ) continue;

        $edu_year = $_POST['edu_year'.$i];
        $school = $_POST['edu_school'.$i];

        if ( strlen($edu_year) == 0 || strlen($school) == 0 ) {
            return "All fields are required";
        }

        if ( ! is_numeric($edu_year) ) {
            return "Education year must be numeric";
        }
    }

    return true;
}

function getProfileById($id): mixed{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM profile WHERE profile_id=:pid and user_id=:uid');
    $stmt->execute(array(':uid' => $_SESSION['user_id'], ':pid' => $id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getPositionsById($id): bool|array{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM position WHERE profile_id=:pid ORDER BY `rank`');
    $stmt->execute(array(':pid' => $id));
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
}
function getEducationById($id): bool|array{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM education WHERE profile_id=:pid ORDER BY `rank`');
    $stmt->execute(array(':pid' => $id));
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
}
function getInstitutionsById($id): bool|array{
    global $pdo;
    $stmt = $pdo->prepare('SELECT A.* FROM institution A JOIN education B on A.institution_id = B.institution_id WHERE B.profile_id=:id');
    $stmt->execute(array(':id' => $id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getInstitutionsByName($name): bool|array{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM institution WHERE name=:nm");
    $stmt->execute(array(':nm' => $name));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function postProfileDB(): bool|string{
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO profile (user_id, first_name, last_name, email, headline, summary) VALUES ( :uid, :fn, :ln, :em, :he, :su)');
    $stmt->execute(array(
            ':uid' => $_SESSION['user_id'],
            ':fn' => $_POST['first_name'],
            ':ln' => $_POST['last_name'],
            ':em' => $_POST['email'],
            ':he' => $_POST['headline'],
            ':su' => $_POST['summary'])
    );
    return $pdo->lastInsertId();
}
function postPositionDB($profile_id): void{
    global $pdo;
    $rank=1;
    for($i=1; $i<=9; $i++) {
        if ( ! isset($_POST['year'.$i]) ) continue;
        if ( ! isset($_POST['desc'.$i]) ) continue;
        if(isset($_POST['year'.$i]) && isset($_POST['desc'.$i])){
            $stmt = $pdo->prepare('INSERT INTO position (profile_id, `rank`, year, description) VALUES ( :pid, :rk, :yr, :dc)');
            $stmt->execute(array(
                ':pid' => $profile_id,
                ':rk' => $rank,
                ':yr' => $_POST['year'.$i],
                ':dc' => $_POST['desc'.$i]
            ));
            $rank++;
        }
    }
}
function postInstitutionDB($name):int{
    global $pdo;
    $ins = getInstitutionsByName($name);
    if ($ins === false) {
        $stmt = $pdo->prepare('INSERT INTO institution (name) VALUES ( :nm)');
        $stmt->execute(array( ':nm' => $name));
        return $pdo->lastInsertId();
    }
    return $ins['institution_id'];
}
function postEducationDB($institution_id, $profile_id, $rank, $year):int{
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO education (profile_id, `rank`, year, institution_id) VALUES ( :pid, :rk, :yr, :iid)');
    $stmt->execute(array(
        ':pid' => $profile_id,
        ':rk' => $rank,
        ':yr' => $year,
        ':iid' => $institution_id
    ));
    return $pdo->lastInsertId();
}

function deleteOldPosition($profile_id): int{
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM position WHERE profile_id=:pid');
    $stmt->execute(array(':pid' => $profile_id));
    return $stmt->rowCount();
}
function deleteOldEducations($profile_id): int{
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM education WHERE profile_id=:pid');
    $stmt->execute(array(':pid' => $profile_id));
    return $stmt->rowCount();
}


function updateProfilesByIds(): bool|string{
    global $pdo;
    $stmt = $pdo->prepare('UPDATE profile SET user_id =:uid, first_name =:fn, last_name=:ln, email=:em, headline=:he, summary=:su WHERE user_id=:uid and profile_id=:pid');
    $stmt->execute(array(
            ':uid' => $_SESSION['user_id'],
            ':pid' => $_GET['profile_id'],
            ':fn' => $_POST['first_name'],
            ':ln' => $_POST['last_name'],
            ':em' => $_POST['email'],
            ':he' => $_POST['headline'],
            ':su' => $_POST['summary'])
    );
    return $stmt->rowCount();
}