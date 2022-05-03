// Primitive types variables are passed by value or copy by value
// Object types variables are passed by reference or copy by reference

let a = 7;
let b = a;
console.log("a: "+a);
console.log("b: "+b);

b=5;
console.log("after b update:");
console.log("a: "+a);
console.log("b: "+b);

// Pass arguments by value
function changePrimitive(primValue){
    console.log('in changePrimitive...');
    console.log("before: "+primValue);
    primValue = 5;
    console.log("after`: "+primValue);
}
let prim = 7;
changePrimitive(prim);
console.log('after changePrimitive, orig value:'+prim);

let x = { a: 7 };
let y = x;
console.log(x);
console.log(y);

y.a= 5;
console.log("after y.a update:");
console.log(x);
console.log(y);


// Pass arguments by reference
function changeObject(objValue){
    console.log('in changeObject...');
    console.log("before: "+objValue);
    objValue.o = 5;
    console.log("after`: "+objValue);
}
let obj = { o : 7 };
changeObject(obj);
console.log('after changeObject, orig value:'+obj);