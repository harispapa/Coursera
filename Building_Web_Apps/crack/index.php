<!DOCTYPE html>
<html lang="en">
<head>
    <title>Charles Severance MD5 Cracker</title>
</head>
<body style="font-family: sans-serif">
<h1>MD5 cracker</h1>
<p>This application takes an MD5 hash of a four digit pin and check all 10,000 possible four digit PINs to determine the PIN.</p>
<pre>Debug Output:
<?php
    $goodText = "Not found";

    // If there is no parameter, this code is all skipped
    if (isset($_GET['md5'])) {
        $time_pre = microtime(true);
        $md5 = $_GET['md5'];

        // This is our alphabet
        $txt = "0123456789";
        //$txt = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ!@#$%^&*()_+";
        $show = 15;
        $checks = 1;
        $check = '';
        $try = '';

        // Outer loop to go through the alphabet for the first position in our "possible" pre-hash text
        for ($i = 0; $i < strlen($txt); $i++) {
            $ch1 = $txt[$i];   // The first character

            // Our inner loop. Note the use of new variables $j and $ch2
            for ($j = 0; $j < strlen($txt); $j++) {
                $ch2 = $txt[$j];  // Our second character

                for($k=0; $k< strlen($txt); $k++){
                    $ch3 = $txt[$k];  // Our third character

                    for($l=0; $l < strlen($txt); $l++) {
                        $ch4 = $txt[$l];  // Our fourth character

//                        for($m=0; $m < strlen($txt); $m++) {
//                            $ch5 = $txt[$m];  // Our fifth character
//
//                            for($o=0; $o < strlen($txt); $o++) {
//                                $ch6 = $txt[$o];  // Our sixth character

                                // Concatenate the two characters together to form the "possible" pre-hash text
                                $try = $ch1 . $ch2 . $ch3 . $ch4;
                                //$try = $ch1 . $ch2 . $ch3 . $ch4 . $ch5 .$ch6;

                                // Run the hash and then check to see if we match
                                $check = hash('md5', $try);
                                if ($check == $md5) {
                                    $goodText = $try;
                                    break;   // Exit the inner loop
                                }

                                // Debug output until $show hits 0
                                $checks++;
                                if ($show > 0) {
                                    print "$check $try\n";
                                    $show = $show - 1;
                                }
//                            }
//                            if ($check == $md5) break;   // Exit the inner loop
//                        }
//                        if ($check == $md5) break;   // Exit the inner loop
                    }
                    if ($check == $md5) break;   // Exit the inner loop
                }
                if ($check == $md5) break;   // Exit the inner loop
            }
            if ($check == $md5) break;   // Exit the inner loop
        }

        // Compute elapsed time
        $time_post = microtime(true);
        print "Total checks:".$checks;
        print "\n";
        print "Elapsed time: ";
        print $time_post - $time_pre;
        print "\n";
    }
    ?>
</pre>
<!-- Use the very short syntax and call htmlentities() -->
<p>Original Text: <?= htmlentities($goodText); ?></p>
<form>
    <label for="name">
    <input type="text" name="md5" size="60"/>
    </label>
    <input type="submit" value="Crack MD5"/>
</form>
<ul>
    <li><a href="index.php">Reset this page</a></li>
    <li><a href="makepin.php">MD5 an MD5 PIN</a></li>
    <li><a href="md5.php">MD5 Encoder</a></li>
    <li><a href="https://github.com/csev/wa4e/tree/master/code/crack" target="_blank">Source code for this application</a></li>
</ul>
</body>
</html>