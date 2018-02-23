<?php
session_start();
include ROOT . $contentPathsocial . 'Google_Client.php'; // has all the css includes
include ROOT . $contentPathsocial . 'contrib/Google_Oauth2Service.php'; // has all the css includes
/*
 * Configuration and setup Google API
 */
$clientId = ''; //Google client ID
$clientSecret = ''; //Google client secret
$redirectURL = 'http://cryptoklout.com'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Klout');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
