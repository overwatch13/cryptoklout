<?php
// define Remote Server routes
define ('ROOT', $_SERVER['DOCUMENT_ROOT'] . "/");
$contentPathsocial = "social/";
//Include GP config file
//include_once 'social/gpConfig.php';
include_once ROOT . $contentPathsocial . 'gpConfig.php';

//Unset token and user data from session
unset($_SESSION['token']);
unset($_SESSION['userData']);

//Reset OAuth access token
$gClient->revokeToken();

//Destroy entire session
session_destroy();

//Redirect to homepage
header("Location:index.php");
?>
