<?php
require_once (__DIR__ . '/config.php');
//require_once(ROOT . '_scripts/sessions.php');
//require_once(ROOT . '_functions/users.functions.php');
//require_once(ROOT . '_functions/at.functions.php');

// so if you dont specify a unique path for the content, than it will use the regular path. 
// example of a unique path is /pages/oracle/2412.php
if(!isset($GLOBALS['contentPathRootUnique'])){
	$contentPathRootUnique = $contentPathRoot; 
}

include ROOT . $contentPath . $contentPathRoot . 'header.php'; // has all the css includes 
include ROOT . $contentPath . $contentPathRoot . 'navigation.php';  // logo, register, member, sign in, contact
include ROOT . $contentPath . $contentPathRootUnique . $contentDisplay;  // $contentDisplay defined in the original file. such as index.php
include ROOT . $contentPath . $contentPathRoot . 'footerContent.php';  
include ROOT . $contentPath . $contentPathRoot . 'footerScripts.php';  
?>

   
