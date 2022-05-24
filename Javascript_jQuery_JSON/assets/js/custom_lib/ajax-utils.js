/**
 * This library creates an object literal named $ajaxUtils.
 * @type {{getRequestObject: $ajaxUtils.getRequestObject, handleResponse: $ajaxUtils.handleResponse,
 * sendGetRequest: $ajaxUtils.sendGetRequest, printRequestResponse: $ajaxUtils.printRequestResponse}}
 */
let ajaxUtils = {
    getRequestObject: function(){
        if(window.XMLHttpRequest) return (new XMLHttpRequest());
        else if (!window.ActiveXObject) {
            window.alert("Ajax is not supported!");
            return null;
        }
        else return (new ActiveXObject("Microsoft.XMLHTTP"));
    },
    handleResponse: function (request, responseHandler, isJsonResponse) {
        if ((request.readyState === 4) && (request.status === 200)) {
            if (isJsonResponse === undefined) isJsonResponse = true;
            if (isJsonResponse)
                responseHandler(JSON.parse(request.responseText));
            else
                responseHandler(request.responseText);
        }
    },
    sendGetRequest: function (requestUrl,responseHandler,isJsonResponse) {
        let request = this.getRequestObject();
        request.onreadystatechange = function () {
            ajaxUtils.handleResponse(request, responseHandler, isJsonResponse);
        };
        request.open("GET", requestUrl, true);
        request.send(null); // for Post Only
    },
    printRequestResponse: function (request) {
        console.log(request);
    }
};
window.$ajaxUtils = ajaxUtils;