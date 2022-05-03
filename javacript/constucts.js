/* Common Language Constructs */

// ***** String Concatenation ***** //
let string = "Hello";
string += " World";
console.log(string + "!");

// ***** Regular Math Operators ***** //
console.log((5+4)/3);
console.log(undefined/3);  // Not A Number = NaN

//***** Equality ***** //
let x1 =4, y1 = 4;
if (x1 == y1)
    console.log('is equal');
x1 = '4'
if (x1 == y1) // Type coercion
    console.log('is equal');

//*****  Strict Equality ***** //
if (x1 === y1)
    console.log('is equal');
else
    console.log('is not equal');

//***** If statement (all false) *****/
if ( false || null || undefined || "" || 0 || NaN)
    console.log("This line won't ever execute");
else
    console.log("All false");

//***** If statement (all true) *****/
if (true && "hello" && 1 && -1 && "false" )
    console.log("All true");

//***** Best practise for {} style *****//
// Curly brace on the same or next line...
function a()
{
    return
    {
        name: "haris"
    };
}

function b(){
    return{
        name: "haris"
    };
}

console.log(a()); // This can't be a function because of the curly brace on definition.
console.log(b());

//***** For Loop *****//
let sum = 0;
for (let i=0; i<10; i++)
    sum += i;
console.log("sum of 0 through 9 is:"+ sum);

//***** Default Values *****//
function concatStr(string){
    string = string || 'whaterver';
    console.log('one string' + string);
}

concatStr();

var x = 10;
if ( (null) || (console.log("Hello")) || x > 5 ) {
    console.log("Hello");
}