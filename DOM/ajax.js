// Event handling
document.addEventListener("DOMContentLoaded",
    function () {

        // Unobtrusive event binding
        document.querySelector("button").addEventListener("click",
            function () {

                // Call servet to get the name
                $ajaxUtils.sendGetRequest("http://localhost:8888/coursera/DOM/data.txt",
                    function (request) {
                        let name = request.responseText;
                        document.querySelector("#content").innerHTML = "<h2>Hello " + name + "!</h2>";
                });
        });
    }
);