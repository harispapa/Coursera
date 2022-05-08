// Event handling
document.addEventListener("DOMContentLoaded",
    function () {

        // Unobtrusive event binding
        document.querySelector("button").addEventListener("click",
            function () {

                // Call servet to get the name
                $ajaxUtils.sendGetRequest("http://localhost:8888/coursera/DOM/data.json",
                    function (request) {
                        let name = request.firstName;
                        document.querySelector("#content").innerHTML = "<h2>Hello " + name + "!</h2>";
                });
        });
    }
);