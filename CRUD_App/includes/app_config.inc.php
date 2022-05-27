<?php #Script config.inc.php

# **************************************************#
#  File name     : config.inc.php                   #
#  Created by    : Charilaos Papamatthaiou          #
#  Contact       : haris.papamattheu@gmail.com      #
#  Last Modified : May 27, 2022                     #
# **************************************************#

# ******************** SETTINGS ******************** #

# Set default timezone:
date_default_timezone_set('Europe/Athens');

# Get current date and time:
$date = new Datetime("Now");
$currentDate = $date->format('Y-m-d H:i:s');

$currentTime = new DateTime();
$currentTime=$currentTime->getTimestamp();

# Set contact email:
$contact_email = 'haris.papamattheu@gmail.com';

# Set cookie expiration for 1 month:
$cookieExpirationTime = $currentTime + (60 * 60);//(30 * 24 * 60 * 60);

# Determine the location of files and the URL of the site :
$docRoot = filter_input(INPUT_SERVER,'DOCUMENT_ROOT', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

# Determine the main directory of the app:
$uri = filter_input(INPUT_SERVER,'REQUEST_URI', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$uris = explode('/',$uri);

# Get the directories and store them into an array:
$appPath = $docRoot.$uri;

# Set include path:
set_include_path($appPath);

# Determine whether we're working on a local or the real server :
$host = $_SERVER['HTTP_HOST'];

# Set application path with domain:
$appPathWithHost = 'http://'.$host.$uri;

if (in_array($host,array('local','127.0','192.1','localhost'))){
    $local = TRUE;
    $debug = TRUE;
}
else{
    $local = FALSE;
    $debug = FALSE;
}

# Assume debugging is off:
if (!isset($debug))
    $debug = FALSE;

# Activate sessions:
session_start();

# Set global variables
$isLoggedIn = false;

# ******************** SETTINGS ******************** #