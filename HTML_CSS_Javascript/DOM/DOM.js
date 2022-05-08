// Document Object Manipulation
let nameObj = document.getElementById('name');
let button  = document.querySelector('button');

function sayHello(){
    document.getElementById("content").innerHTML = "<h3>Hello "+ nameObj.value +"!</h3>";
}

button.addEventListener('click',sayHello);