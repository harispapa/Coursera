/* Javascript 7 Data structure types*/

/* Object Type - is a collection of name/value pairs */
let person = {
    firstName : "Haris",
    lastName  : "Papas",
    social    : {
        facebook  : "www.facebook.com/haris",
        instagram : "www.instagram.com/haris",
        twitter   : "www.twitter.com/haris"
    }
}

/* Primitive type - represents a single, immutable value */
/* immutable - it can't be changed, value becomes a read-only */

let isAdmin = true;   /* Boolean */
let x1;               /*  undefined - No value has ever been set but memory has allocated */
let x2 = null;        /* The opposed to undefined    */
let x3 = 5;           /* All numbers are double 65-bit floating type */
let x4 = 'hello world'/* A single string */
let x5 = Symbol;      /* Is new to ES6 */