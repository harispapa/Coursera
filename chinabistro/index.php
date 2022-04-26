<?php # Script - index.php - I just include things:
include("includes/themes/simple_theme/head.html");
include("includes/themes/simple_theme/nav.html");

// Get the action variable from GLOBAL tables POST,GET,
// if the action is missing on both tables then set default value:
$action = filter_input(INPUT_GET,'action');
if ($action === NULL) {
    $action = filter_input(INPUT_POST, 'action');
    if ($action === NULL)
        $action = 'home';
}
switch($action){
     case 'home':
        include("includes/themes/simple_theme/main.html");
     break;
     case 'menu':
       include("includes/themes/simple_theme/menu.html");
     break;
     case 'about':
       include("includes/themes/simple_theme/about.html");
     break;
     case 'awards':
        include("includes/themes/simple_theme/awards.html");
     break;
     case 'specials':
        include("includes/themes/simple_theme/menu.html");
     break;
}

include("includes/themes/simple_theme/footer.html");
?>