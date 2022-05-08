/** Javascript Scopes **/

/* Example 1 */
/* Here is the global scope, where functions A(),B() and variable x are created */
let x=2;
function B() {
    /* Here is the function scope of function B(). This x variable is pointed to the global scope x variable, */
    /* because function B() is created on global scope */
    console.log(x);
}
function A(){
    /* Here is the function scope of function A(), where a new version of variable x is created. */
    let x = 5;
    /* Invoke function B() from global scope */
    B();
}

/* Invoke function A() from global scope, the result will print the value 2 */
A();

/* Example 2 */
/* Here is the global scope, where function C() and variable a are created */
let a=2;
function C(){
    /* Here is the function scope of function C() where a new version of variable a, and function D() is created. */
    let  a=5;
    function D() {
        /* Here is the function scope of function D(). This a variable is pointed to the C() function scope x variable */
        console.log(a);
    }
    /* Invoke function D() from C()'s function scope */
    D();
}
/* Invoke function C() from global scope */
C(); /* The console.log will print the value 5 */