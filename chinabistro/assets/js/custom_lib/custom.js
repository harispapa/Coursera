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
    let allCategoriesMenu = "https://davids-restaurant.herokuapp.com/categories.json";

    // On page load (before images or css)
    document.addEventListener("DOMContentLoaded", function (event) {
        // On first load, show home view
        showLoading("#home_page");
        $ajaxUtils.sendGetRequest(homeMainContent,  (responseText) => {
            if ( document.querySelector("#home_page") !== null)
                document.querySelector("#home_page").innerHTML = responseText;
        }, false);
    });

    // Load the menu categories view:
    dc.loadMenuCategories = function () {
        showLoading("#menu_page .row");
        $ajaxUtils.sendGetRequest(allCategoriesMenu, buildAndShowCategoriesHTMl);
    };

    // Show Html for categories page based on the data from the server:
    function buildAndShowCategoriesHTMl(categories) {
        $ajaxUtils.sendGetRequest(categoriesContent, function (categoriesContent) {
            let categoriesHtml = buildCategoriesViewHtml(categories);
            insertHtml("#menu_page .row",categoriesHtml);
        }, false);
    }

    // Build Html for categories page based on the data from the server:
    function buildCategoriesViewHtml(categories) {
        let categoryHtml = '<div class="col-lg-3 col-md-4 col-sm-6">\n' +
            '    <div class="plate">\n' +
            '        <img src="content/images/menu/{{short_name}}.jpeg" alt="{{name}}">\n' +
            '        <div class="plate-title">\n' +
            '            <a href="menu.php?name={{short_name}}.jpeg">{{name}}</a>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>';

        let categoriesHtml = '';
        for (let i = 0; i<categories.length-8; i++){
            let name = categories[i].name;
            let short_name = categories[i].short_name;
            let html = insertProperty(categoryHtml, "name", name);
            html = insertProperty(html,"short_name", short_name);
            categoriesHtml+=html;
        }
        return categoriesHtml;
    }

    global.$dc = dc;
})(window);