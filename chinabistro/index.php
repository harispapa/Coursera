<?php # Script - index.php - I just include things:
include("includes/themes/simple_theme/head.html");

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
        $activeMenu= 1;
        include("includes/themes/simple_theme/nav.html");
        include("includes/themes/simple_theme/main.html");
     break;
     case 'menu':
       $activeMenu= 2;
       include("includes/themes/simple_theme/nav.html");
       include("includes/themes/simple_theme/menu.html");
     break;
     case 'about':
       $activeMenu= 3;
       include("includes/themes/simple_theme/nav.html");
       include("includes/themes/simple_theme/about.html");
     break;
     case 'awards':
        $activeMenu= 4;
        include("includes/themes/simple_theme/nav.html");
        include("includes/themes/simple_theme/awards.html");
     break;
}

include("includes/themes/simple_theme/footer.html");
?>