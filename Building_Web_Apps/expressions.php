<?php
$x = "15" + 27;  // Type conversion
echo ($x);

$x = 12;
$y = 15 + $x++;
echo "\nx is $x and y is $y \n";

$x = 12;
$y = 15 + ++$x;
echo "\nx is $x and y is $y \n";

// Ternary Opeartor:
$www = 123;
$msg = ($www>100)? "Large" : "Small";
$msg = ($www % 2 == 0)? "Even"  : "Odd";
$msg = ($www % 2)? "Even"  : "Odd";