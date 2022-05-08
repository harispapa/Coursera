(function (global){
    // Set up a namespace for our utility
    let ajaxUtils = {};

    // Return an HTTP request object
    function getRequestObject(){
        if(window.XMLHttpRequest)
            return (new XMLHttpRequest());
        else if (!window.ActiveXObject) {
            global.alert("Ajax is not supported!");
            return null;
        } else
            return (new ActiveXObject("Microsoft.XMLHTTP"));
    }

    // Only calls user provided 'responseHandler' function if response is ready and not an error.
    function handleResponse(request, responseHandler, isJsonResponse) {
        if ((request.readyState === 4) && (request.status === 200)) {
            if (isJsonResponse === undefined) isJsonResponse = true;
            if (isJsonResponse)
                responseHandler(JSON.parse(request.responseText));
            else
                responseHandler(request.responseText);
        }
    }

    // Makes an Ajax GET request to 'requestUrl'
    ajaxUtils.sendGetRequest = function (requestUrl, responseHandler, isJsonResponse) {
        let request = getRequestObject();
        request.onreadystatechange = function () {
            handleResponse(request, responseHandler, isJsonResponse);
        };
        request.open("GET", requestUrl, true);
        request.send(null); // for Post Only
    };

    // Expose utility to the global object:
    global.$ajaxUtils = ajaxUtils;

})(window);