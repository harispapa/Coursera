// Arrays with new operator
let array = new Array();
array[0] = 'haris';
array[1] = 1;
array[2] = function (name) {
    console.log("Hello "+name);
};
array[3] = { course: " Html, Css & Javascript" };

// Shorthand array creation
let names = ['haris',{name : 'man'},'test'];

// Single for loop over the array:
for (let i=0; i<names.length; i++)
    console.log("Hello "+names[i]);

// A special loop for objects and arrays:
let names2 = ['haris', 'man','test'];
let myObj = {
    name : "Haris",
    course : "test",
    platform : "coursera"
};
for (let val in myObj)
    console.log(val + " : " + myObj[val]);

for (let name in names2)
    console.log("hello" + " : " + names2[name]);