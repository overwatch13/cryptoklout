<?php

$local = false;
$addr = $_SERVER['HTTP_HOST'];
$local = preg_match('/localhost/', $addr);
$siteName = "cryptoklout";
$siteurl = ((substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http').'://'.$_SERVER[HTTP_HOST].'/';


if($local==true){
	// Define Local Routes
	define ('ROOT', "C:\wamp64\www\cryptoklout\\"); // HOME path C:\wamp\www\\cryptoklout\\
	$contentPath = "content\\"; 
	$contentPathRoot = "root\\";
	$cssJSPath = "\\cryptoklout\\";
}
else if(empty($_SERVER['DOCUMENT_ROOT'])){ // From linux server perspective like a crontab request.
	// define Remote Server routes
	define ('ROOT', "/home/cryptoklout/public_html" . "/"); 	
}
else {
	define ('ROOT', $_SERVER['DOCUMENT_ROOT'] . "/"); // remote server path for public_html consumption.	
	$cssJSPath = "/"; // you would need to verify this as correct
	//$atPath = "/at/";
	$contentPath = "content/"; 
	$contentPathRoot = "root/";
	$contentPathsocial = "social/";
}

// Default Meta Information, if nothing else is set. 
if(!isset($metaTitle)){
	$metaTitle = "CryptoKlout.com is the official score for people who make predictions about CryptoCurrency trends";
}
if(!isset($metaDescription)){
	$metaDescription = "";
}
if(!isset($metaKeywords)){
	$metaKeywords = "";
}

include ROOT . "_classes/standards.class.php";
include ROOT . 'social/Google_Client.php';
include ROOT . 'social/contrib/Google_Oauth2Service.php';
include ROOT . "social/twitter/twitteroauth.php";
include ROOT . "/sendgrid-php/sendgrid-php.php";
/* EOF */
