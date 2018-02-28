<?php
// This file loginAuth.php is included from the navigation.php, so it is global.
include ROOT . "_classes/google.class.php";
include ROOT . "_classes/twitter.class.php";
include ROOT . "_classes/loginRelated.class.php";

/* Google Login */
$googleData = new Google();
$returnData = $googleData->googleLogin();

// We are still using this
// Activate User - this gets activated when they hit the activation link
// http://localhost.cryptoklout.com/?isActive=Yes&activate=dGVzdDU0NkBtYWlsaW5hdG9yLmNvbQ==
// Is there any better place for this?
if(isset($_REQUEST['isActive']) && $_REQUEST['isActive']=='Yes' && isset($_REQUEST['activate'])) {
	$customData = new Custom();
	$customLogin = $customData->activateAccountFromUrl(); // does a base64decode on the 'activate' which is actually the email.
}

/* Twitter */
$twitterData = new Twitter();
$returnTData = $twitterData->twitterLogin();
