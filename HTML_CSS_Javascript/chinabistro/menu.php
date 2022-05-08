<?php # Script - menu.php - This page is a simple menu item template

// Get the action variable from GLOBAL tables POST,GET,
// if the action is missing on both tables then redirect to home:
$menu_name = filter_input(INPUT_GET,'name');
$menu_short_name = filter_input(INPUT_GET,'sname');
if (empty($menu_name) || empty($menu_short_name)  ) {
    header("Location: ../chinabistro/index.php", TRUE, 302);
    exit();
}
include("includes/themes/simple_theme/head.html");
$activeMenu= 2;
include("includes/themes/simple_theme/nav.html");
include("includes/themes/simple_theme/single_menu.html");
include("includes/themes/simple_theme/footer.html");
echo '<script>$dc.loadMenuSingleItems()</script>';
?>