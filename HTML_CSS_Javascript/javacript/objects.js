// Object creation with Objects
let company1 = new Object();
company1.name = 'Facebook';
company1.ceo = new Object();
company1.ceo.firstName ='Mark';
company1.ceo.favColor  = 'blue';
console.log(company1);

// Object creation with Object literals:
let company2 = {
    name : "Facebook",
    ceo  : {
        firstName: "Mark",
        favColor : "blue"
    },
    "stock of company" : 100
};
console.log(company2);

// Object creation with constructors functions
function Circle(radius){
    this.radius  = radius;
    this.getArea = function(){
        return Math.PI * Math.pow(this.radius,2);
    };
}
let myCircle = new Circle(10);

// Object creation with constructors functions and prototype to load methods for less memory.
function Circle2(radius){
    this.radius  = radius;
}
Circle2.prototype.getArea= function(){
    return Math.PI * Math.pow(this.radius,2);
};
let myCircle2 = new Circle2(10);


