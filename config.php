<?php

$local = true;
$addr = $_SERVER['HTTP_HOST'];
$local = preg_match('/localhost/', $addr);
$siteName = "cryptoklout";

if($local==true){
	// Define Local Routes
	define ('ROOT', "/"); // HOME path C:\wamp\www\\cryptoklout\\
	$contentPath = "content\\"; 
	$contentPathRoot = "root\\";
	$cssJSPath = "\\cryptoklout\\";
}
<<<<<<< HEAD
else if(empty($_SERVER['DOCUMENT_ROOT'])){ // path when the server is running the script directly. 
	// define Remote Server routes
	define ('ROOT', "/home/cryptoklout/public_html" . "/"); 	
}
else {
=======
else{
>>>>>>> a5a05c54dd4c8cbb32d0db6ab3bdb293029ebbb0
	// define Remote Server routes
	define ('ROOT', $_SERVER['DOCUMENT_ROOT'] . "/"); 	
	$cssJSPath = "/"; // you would need to verify this as correct
	//$atPath = "/at/";
	$contentPath = "content/"; 
	$contentPathRoot = "root/";
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


/* EOF */