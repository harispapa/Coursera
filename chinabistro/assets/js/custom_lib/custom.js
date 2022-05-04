$( function () {
    $("#navbarToggle").blur(function (event) {
        if (window.innerWidth< 768)
            $('#navList').collapse('hide');
    });
});

(function(global){
    let dc = {};
    let homeMainContent = "includes/themes/simple_theme/inc/main_content.html";

    // Convenience function for inserting innerHtml for 'select'
    let insertHtml = (selector, html) => {
        document.querySelector(selector).innerHtml = html;
    };

    // Show loading icon inside element identified by 'selector'
    let showLoading = function (selector) {
        let html = '<div class="text-center"><img src="content/images/480px-Loader.gif" alt="loader image"></div>';
        insertHtml(selector,html);
    }

    // On page load (before images or css)
    document.addEventListener("DOMContentLoaded", function (event) {
        // On first load, show home view
        showLoading("#home_page");
        $ajaxUtils.sendGetRequest(homeMainContent,  (responseText) => {
            document.querySelector("#home_page").innerHTML = responseText;
        }, false);
    });

    global.$dc =dc;
})(window);


// Convenience function for inserting innerHtml for 'select'
let insertHtml = (selector, html) => {
    document.querySelector(selector).innerHtml = html;
};

// Show loading icon inside element identified by 'selector'
let showLoading = function (selector) {
    let html = '<div class="text-center"><img src="content/images/480px-Loader.gif" alt="loader image"></div>';
    insertHtml(selector,html);
}