<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Name is Charilaos Papamatthaiou 93a07daa</title>
</head>
<body>
<header></header>
<main>
    <h1>Welcome to my guessing game</h1>
    <p>
        <?php
            $reqParam = $_GET['guess'];
            if (!isset($reqParam))
                echo ('Missing guess parameter');
            else if (strlen($reqParam)<1)
                echo ('Your guess is too short');
            else if (!is_numeric($reqParam))
                echo ('Your guess is not a number');
            else if ($reqParam<62)
                echo ('Your guess is too low');
            else if ($reqParam>62)
                echo ('Your guess is too high');
            else
                echo("Congratulations - You are right");
        ?>
    </p>
</main>
<footer></footer>
</body>
</html>