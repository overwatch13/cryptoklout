<?php
session_start();
//Include Google client library 
include_once 'social/Google_Client.php';
include_once 'social/contrib/Google_Oauth2Service.php';

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
