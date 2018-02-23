<?php
if(!session_id()){
    session_start();
}

//Include Twitter client library 
include ROOT . $contentPathsocial . 'twitteroauth.php';

/*
 * Configuration and setup Twitter API
 */
$consumerKey = 'et0ETfvrpbg9GMXwKK4syrCJE';
$consumerSecret = 'sTSnCXv3muOv0YNPkAhlmJU4rB9bMujafG6Jb9wl4OXCexYNtu';
$redirectURL = 'http://cryptoklout.com';

?>
