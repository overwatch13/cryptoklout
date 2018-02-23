<?php

include ROOT . "_classes/google.class.php";
include ROOT . "_classes/twitter.class.php";
include ROOT . "_classes/custom.class.php";

/* Google Login */
$googleData = new Google();
$returnData = $googleData->googleLogin();

/*Login Custom */

if(isset($_POST['submitLogin'])) {
	$customData = new Custom();
	$customLogin = $customData->customLogin($_POST["email"],md5($_POST["password"]));
}

/* Register */

if(isset($_POST['submitRegister'])) {
	$customData = new Custom();
	$customLogin = $customData->customRegister($_POST["email"],md5($_POST['password']));
}

/* Forgot Passwrod */ 

if(isset($_POST['submitForgot']) && $_POST["email"] != "") {
	$customData = new Custom();
	$customLogin = $customData->customForgot($_POST["email"]);
}

/* Active User */
if(isset($_REQUEST['isActive']) && $_REQUEST['isActive']=='Yes' && isset($_REQUEST['id'])) {
	$customData = new Custom();
	$customLogin = $customData->IsActive();
}


/* Change Password */
if(isset($_POST['submitChange']) && isset($_REQUEST['id'])) {
	$customData = new Custom();
	$customLogin = $customData->customChange($_POST['newpass'],$_POST['changepass']);
}


/* Twitter */
$twitterData = new Twitter();
$returnTData = $twitterData->twitterLogin();
?>
