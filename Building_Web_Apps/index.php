<?php # Script - index.php - I just include things:
include("includes/themes/simple_theme/head.html");
include("includes/themes/simple_theme/nav.html");

// Get the action variable from GLOBAL tables POST,GET
$action = filter_input(INPUT_GET,'action');
if ($action === NULL)
    $action = filter_input(INPUT_POST, 'action');
switch($action){
    case 'Menu':
        echo 'Menu';
    break;
    default:
        include("includes/themes/simple_theme/main.html");
    break;
}
include("includes/themes/simple_theme/footer.html");