<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/_functions/ck.functions.php';

$return = array(
	'success' => TRUE,
	'errors' => array()
);

switch ($_REQUEST['operation']){
	case 'submitSingleDayPrediction': 
		$return = $_REQUEST;
		$construct = array(
			'class' => 'singleDayPrediction', 
			'function' => $_REQUEST['function'], 
			'userId' => 2, // $_SESSION['userID'] when you get login working 
			'post' => $_POST);
		$return = ckRouter($construct);
		break;
}

// old construct the way you did it in AT.
/*'classFunction' => $_REQUEST['operation'], 
'apiClassName' => $_REQUEST['apiClassName'], 
'userID' => 1, // $_SESSION['userID'] when you get login working 
'post' => $_POST*/

//echo json_encode($construct);
echo json_encode($return);

