<?php

include ROOT . "_classes/predictions/predictions.class.php"; // gets 1 or more predictions
include ROOT . "_classes/predictor/predictor.class.php"; // personal info
include ROOT . "_classes/pricetrackingbtc.class.php"; // price tracking btc info.

$predictionId = null;
$runPage = false;
if(isset($_GET['id'])) {
	$predictionId = $_GET["id"];
	$Predictions = new Predictions(); 
	$singlePredictionResult = $Predictions->getPredictionSingle($predictionId); // this simply gets the data to work with. this is not were the logic is. 
	
	$predictionSingleData = $singlePredictionResult['query'][0];
	
	if($predictionSingleData == null || sizeof($predictionSingleData)==0){
		// keep $runPage = false;
	}else{
		$runPage = true;
	}
	
}

// Get personal information
if($runPage){ // now that we now we are looking at some stuff, lets get some additional information like who the predictor is. 
	$predictorClass = new Predictor();
	$predictorInfo = $predictorClass->getPredictorPersonalInformation($predictionSingleData['userId']);
	$predictorPersonalInfo = $predictorInfo['query'];
}

// Get the proper BTC data, within a date range based on the timestamp of the predictions.
if($runPage){ 
	$dateTime1 = new DateTime($predictionSingleData['timestamp']); 
	$dateTime2 = new DateTime($predictionSingleData['timestamp']); // need two separate variables
	
	$dateTimePast = $dateTime1->modify('-7 days');
	$dateTimeFuture = $dateTime2->modify('+7 days');
	// You might need some different ranges based on the predictionDays amount, you would have a separate class that would calculate teh begin and end date for you. 

	$dateTimePast = $dateTimePast->getTimeStamp();
	$dateTimeFuture = $dateTimeFuture->getTimeStamp();

	//https://stackoverflow.com/questions/18132181/add-days-to-a-timestamp
	$timeRange = array(
		"beginTime" => date("Y-m-d H:i:s", $dateTimePast),
		"endTime" => date("Y-m-d H:i:s", $dateTimeFuture),
	);
	$priceTrackingClass = new PriceTrackingBtc();
	$priceTrackingRangeArr = $priceTrackingClass->getBtcBetweenTimestamp($timeRange);
	$priceTrackingRangeArr = $priceTrackingRangeArr['query']; // gives you an array of btc data increments.
}

// For testing
if($runPage){ // now that we now we are looking at some stuff, lets get some additional information like who the predictor is. 
	/*echo "<pre style='font-size:11px;'>";
	print_r($predictionSingleData);
	print_r($predictorPersonalInfo);
	echo "<br/> Attempting to subtract and add 7 days from the prediction timestamp";
	print_r($priceTrackingRangeArr[0]);
	echo "</pre>";*/
}


