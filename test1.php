<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//
// include "config.php";
// include ROOT . "_classes/email/sendEmail.class.php";
// include ROOT . "_classes/email/registrationContent.class.php";
//
// // $EmailContentClass = new EmailContent();
// // $emailContent = $EmailContentClass->Registration();
// // echo $emailContent;
// // $email = new Email();
// // $email->sendEmail("williamhowley@gmail.com", "CryptoKlout Email Registration", $emailContent);
//
// $EmailContentClass = new Email();
// $EmailContentClass->sendWarningToAdmin("Test message");
// echo $emailContent;
// $email = new Email();
// $email->sendEmail("williamhowley@gmail.com", "CryptoKlout Email Registration", $emailContent);

echo sha1(time());
echo "<BR/>";
echo sha1(time());

//
// echo "<pre style='font-size:11px;'>";
// echo print_r($rpResponse);
// echo "</pre>";

// echo __DIR__;
// echo "<BR/>";
// echo $_SERVER['DOCUMENT_ROOT'];
// echo "<BR/>";
// echo ROOT;

// echo "<BR/>";
// echo substr($_SERVER["SERVER_PROTOCOL"],0,5);
// echo "<BR/>";
// if(substr($_SERVER["SERVER_PROTOCOL"],0,5) == "http"){
// 	echo "True";
// }else{
// 	echo "False";
// }
// echo "<BR/>";
// echo $_SESSION['email'];
//
// $siteurl = ((substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http').'://'.$_SERVER["HTTP_HOST"].'/';
// echo $siteurl;


?>
