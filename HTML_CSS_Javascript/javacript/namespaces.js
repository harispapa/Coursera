// Fake Namespaces in javascript using objects
// Script 1.js
let myNameSpace = {};
myNameSpace.name = 'haris';
myNameSpace.greetings = function (){
    console.log("hello "+ myNameSpace.name);
}

// Script 2.js
let myNameSpace2 = {};
myNameSpace2.name = 'john';
myNameSpace2.greetings = function (){
    console.log("hello "+ myNameSpace2.name);
}

// Script 3.js -  Invoke the methods:
myNameSpace.greetings();
myNameSpace2.greetings();
