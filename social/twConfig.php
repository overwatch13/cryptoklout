<?php
if(!session_id()){
    session_start();
}

//Include Twitter client library 
include ROOT . $contentPathsocial . 'twitteroauth.php';

/*
 * Configuration and setup Twitter API
 */
$consumerKey = '';
$consumerSecret = '';
$redirectURL = 'http://cryptoklout.com';

?>
