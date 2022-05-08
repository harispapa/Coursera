// Closures in javascript
function makeMultiplier(multiplier){
    return (
        function (x){
            return multiplier*x;
        }
    );
}