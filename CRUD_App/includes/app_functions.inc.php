<?php

# **************************************************************** #
# *********************** ERROR MANAGEMENT *********************** #

# Create the error handler Set the error functions for debugging:
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars): void{
    # Define functions variables:
    global $debug, $contact_email;

    # Build The Error Message:
    $message = "An error occurred in script '$e_file' on line $e_line with number $e_number : $e_message\n";
    if ($debug){
        // Create error log file :
        error_log(date("Y-m-d,h:i:sa").' : '.$message, 3, './logs/error_log' );

        // Append $e_vars to $message:
        $message .= print_r($e_vars, 1);

        // Development, Print the errors:
        echo ('<div class="error"><pre>'.$message."\n");

        // Call a debug function:
        debug_print_backtrace();

        // Finish The Print of pre:
        echo ('</pre></div><br/>');
    }
    else {
        # Email the error :
        error_log($message, 1, $contact_email );

        // Only print out the errors if they aren't a notice or strict :
        if ( $e_number != E_NOTICE && $e_number<2048 )
            echo ('<div class="error"> A system error occurred. We Apologize for the inconvenience.</div><br />');
    }
}
// End of my_error_handler() function's definition.

// Use the new error handler:
set_error_handler('my_error_handler');

# **************** ERROR MANAGEMENT **************** #
# ************************************************** #