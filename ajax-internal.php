<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . "/_classes/standards.class.php"; // this is causing an error when I include it!!!
require_once $_SERVER['DOCUMENT_ROOT'] . '/_functions/ck.functions.php'; // (includes standard.class.php) it would be nice if this could be a universal function we can pass stuff too, but not sure. 
//require_once $_SERVER['DOCUMENT_ROOT'] . "/_classes/predictions/prediction-consensus.php"; // causes a failure when you add this in!!!!
include ROOT . "_classes/submitRecurringCoinInfo.class.php"; // used to submit the btc info.


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
		
	// being used from a homepage widget, this will change over time. This is a simple starting example.
	case 'getPredictions': 
	    $Predictions = new Predictions();
        $return = $Predictions->getPredictions($_REQUEST);
		//$return = $_REQUEST; // test
		break;
		
	case 'getPredictionConsensus': 
	    $PC = new PredictionConsensus();
        $data = $PC->getPredictionConsensus();
		$return = $data; // test
		break;
		
	case 'submitBTCData':
	    $return = $_POST; // test
	    $submitCoinInfo = new submitRecurringCoinInfo();
	    $return = $submitCoinInfo->submitBTC($_POST);
	    break;
		

}

// old construct the way you did it in AT.
/*'classFunction' => $_REQUEST['operation'], 
'apiClassName' => $_REQUEST['apiClassName'], 
'userID' => 1, // $_SESSION['userID'] when you get login working 
'post' => $_POST*/

//echo json_encode($construct);
echo json_encode($return);

