// Fix an issue with navigation bar mobile
$(function () {
    $("#navbarToggle").blur(function (event) {
        if (window.innerWidth< 768)
            $('#navList').collapse('hide');
    });
});

// Convenience function for inserting innerHtml for 'select'
let insertHtml = (selector, html) => {
    if ( document.querySelector(selector) !== null)
        document.querySelector(selector).innerHTML = html;
};

// Show loading icon inside element identified by 'selector'
let showLoading = function (selector) {
    let html = "<div class='text-center'><img src='content/images/480px-Loader.gif' alt='loader image'></div>";
    insertHtml(selector,html);
};

// Return substitute of {{propName}} with propValue in given 'string'
let insertProperty = function (string, propName, propValue) {
    let propToReplace = "{{" + propName + "}}";
    string = string.replace(new RegExp(propToReplace,"g"),propValue);
    return string;
};

(function(global){
    let dc = {};
    let homeMainContent   = "includes/themes/simple_theme/content/home.html";
    let categoriesContent = "includes/themes/simple_theme/content/categories.html";
    let menuItemContent = "includes/themes/simple_theme/content/item.html";
    let allCategoriesMenu = "https://davids-restaurant.herokuapp.com/categories.json";

    // On Homepage load menu main categories (before images or css):
    document.addEventListener("DOMContentLoaded", function (event) {
        // On first load, show home view
        showLoading("#home_page");
        $ajaxUtils.sendGetRequest(homeMainContent,  (responseText) => {
            if ( document.querySelector("#home_page") !== null)
                document.querySelector("#home_page").innerHTML = responseText;
        }, false);
    });

    // Load the menu categories view (before images or css):
    dc.loadMenuCategories = function () {
        // Show loading on category page:
        showLoading("#menu_page .row");

        // Make the Ajax API call:
        $ajaxUtils.sendGetRequest(allCategoriesMenu, showCategoriesHTMl);

        // Show Html for categories page based on the data from the server:
         function showCategoriesHTMl (allCategoriesMenu) {
            // Load categories template page from server and wait to get the file:
            $ajaxUtils.sendGetRequest(categoriesContent, function (categoriesContent) {
                let categoriesHtml = buildCategoriesViewHtml(allCategoriesMenu, categoriesContent);
                insertHtml("#menu_page .row",categoriesHtml);
            }, false);
        }

        // Build Html for categories page based on the data from the server:
        function buildCategoriesViewHtml(categories,categoriesContent) {
            let categoriesHtml = '';
            for (let i = 0; i<categories.length-8; i++){
                let name = categories[i].name;
                let short_name = categories[i].short_name;
                let html = insertProperty(categoriesContent, "name", name);
                html = insertProperty(html,"short_name", short_name);
                categoriesHtml+=html;
            }
            return categoriesHtml;
        }
    };

    // Load the menu categories view (before images or css):
    dc.loadMenuSingleItems = function () {
        // Show loading on category page:
        showLoading("#menu_page .row");

        // Make the Ajax API call:
        $ajaxUtils.sendGetRequest(menuItemContent, showItemsHTMl);

        // Show Html for categories page based on the data from the server:
        function showItemsHTMl (menuItems) {
            // Load categories template page from server and wait to get the file:
            $ajaxUtils.sendGetRequest(menuItemContent, function (menuItemContent) {
                let menuItemsHtml = buildItemsViewHtml(menuItems, menuItemContent);
                insertHtml("#single_menu_page .menu-items .row",menuItemsHtml);
            }, false);
        }

        // Build Html for categories page based on the data from the server:
        function buildItemsViewHtml(menuItems,menuItemContent) {
            let itemsHtml = '';
            for (let i = 0; i<menuItems.length-8; i++){
                // let name = categories[i].name;
                // let short_name = categories[i].short_name;
                // let html = insertProperty(menuItemContent, "name", name);
                // html = insertProperty(html,"short_name", short_name);
                itemsHtml+=html;
            }
            return itemsHtml;
        }
    };

    global.$dc = dc;
})(window);