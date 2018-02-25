<?php 
// *** Includes ***
include ROOT . "_classes/predictor/predictor.class.php"; // Predictor() class

$idFound = false;
$predictorFound = false;
$masterArr = array(); // rename this, but currently used for storing all predictions.

//*** GET user id from  /predictor/xxxxx ****
$url = $_SERVER['REQUEST_URI'];
$userId = substr($url,11); 
//echo $url; // should give everything after the /predictor/xxxxx
if(isset($userId) && $userId !==""){
	$idFound = true;
	$masterArr['userId'] = $userId;
}

//*** See if predictor exists, if they do not, then post a message in the profile content ***
if($idFound){
	$predictorClass = new Predictor();
	$predictorInfo = $predictorClass->getPredictorPersonalInformation($userId);
	if(sizeof($predictorInfo['query'])>0){
		$masterArr['predictorInfo'] = $predictorInfo['query'][0];
		$predictorFound = true;
	}
	$masterArr['predictorFound'] = $predictorFound;
}

// if the predictor is found than lets get all of the predictions. 
if($predictorFound){
	$getPredictorPredictions = $predictorClass->getPredictorPredictions($userId);
	$predictorPredictions = $getPredictorPredictions['query'];

	// Iterate through the data and create separate arrays for each of the time frames, 
	// allowing you to easily manipulate the data in JS. this would be a good opportunity to work with react on this one. 
	$predictionListHtml = "";
	foreach($predictorPredictions as $key=>$prediction){
	    //$masterArr['predictionsSeparated'][$prediction['predictionName']][] = $prediction; // creates a new array for each of the types. 
	    $masterArr['predictionsTogether'][] = $prediction;

	    $predictionListHtml .= '<div class="date-box-container">';
	    if($prediction['percentageDifference']>0){
	    	$predictionListHtml .= '<div class="color-coded bg-success"></div>';
	    }else{
	    	$predictionListHtml .= '<div class="color-coded bg-danger"></div>';
	    }
	    $predictionListHtml .= '<div class="date-container"><div class="rotate">'.date("m/d/Y", strtotime($prediction['timestamp'])).'</div></div>';
	    $predictionListHtml .= '</div>';
	    // Extract this into its own function
	}
}






















