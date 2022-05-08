// Functions are First-Class Data Types
// Functions ARE objects
function multiply(x,y){
    return x*y;
}
multiply.version = 'v.1.0.0';
console.log(multiply.version);

// Function factory
function makeMultiplier(multiplier){
    return function (x) {
        return multiplier * x;
    };
}
let multiplyB3 = makeMultiplier(3);
let doubleAll = makeMultiplier(2);
console.log(multiplyB3(10));
console.log(doubleAll(100));

// Passing functions as arguments
function doOperationOn(x, operation){
    return operation(x);
}
let result = doOperationOn(5, multiplyB3);
console.log(result);