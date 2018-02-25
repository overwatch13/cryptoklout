<?php

include ROOT . "_classes/predictions/predictions.class.php"; // gets 1 or more predictions
include ROOT . "_classes/predictor/predictor.class.php"; // personal info
include ROOT . "_classes/pricetrackingbtc.class.php"; // price tracking btc info.
include ROOT . "_classes/dailyAverage.class.php"; // utility class which can calculate the daily average from a ton of data.

$payload = array(); // all assets go inside of here, so they are eaily transferrable to dom.
$predictionId = null;
$runPage = false;

/*** URL settings ***/
$url = $_SERVER['REQUEST_URI'];
$predictionId = substr($url,12);
//echo $predictionId; // should give everything after the /predictor/xxxxx

if(isset($predictionId) && $predictionId !==""){
	$predictionIdFound = true;
	$payload['predictionId'] = $predictionId;
}

if($predictionIdFound) {
	$Predictions = new Predictions();
	$singlePredictionResult = $Predictions->getPredictionSingle($predictionId); // this simply gets the data to work with. this is not were the logic is.
	if(sizeof($singlePredictionResult['query'])>0){
		$predictionSingleData = $singlePredictionResult['query'][0];
		$payload['predictionInfo'] = $predictionSingleData;
		$runPage = true;
	}
}

// Get personal information
if($runPage){ // now that we now we are looking at some stuff, lets get some additional information like who the predictor is.
	$predictorClass = new Predictor();
	$predictorInfo = $predictorClass->getPredictorPersonalInformation($predictionSingleData['userId']);
	$predictorPersonalInfo = $predictorInfo['query'];
	$payload['predictorInfo'] = $predictorPersonalInfo;
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
		"beginDay" => date("m/d/Y", $dateTimePast),
		"endDay" => date("m/d/Y", $dateTimeFuture),
	);
	$payload['dateRangesOriginal'] = $timeRange;
	$priceTrackingClass = new PriceTrackingBtc();
	$priceTrackingRangeArr = $priceTrackingClass->getBtcBetweenTimestamp($timeRange);
	$priceTrackingRangeArr = $priceTrackingRangeArr['query']; // gives you an array of btc data increments.
	$payload['btcDataFromTimeRangeAll'] = $priceTrackingRangeArr;
	// A 15 day spread returns about 900 btc price results, but we only need 1 number for each day.
	// The question is, do we take the highest, the lowest, the last number, or average of each day in order to retreive one number?
	// This also might be slightly problematic as they could have succeeded in their prediction, but it does not display it properly in the graph because it is too generic to see.

	// Taking an average takes more work but would give you a closer number for a single day at least.
	// DAILY AVERAGE ATTEMPT.
	$dailyAverageClass = new DailyAverage();
	$dailyAverageResponse = $dailyAverageClass->createDailyAverage($priceTrackingRangeArr);
	$payload['dailyAverageBtcArr'] = $dailyAverageResponse;

	// Sometimes we specify a 20 day spread and we only have data for 7 of those days.
	// calculate a final array for the javascript to use, this way it does not fail, and always works based on the data that was actually retrieved.
	$payload['graphX'] = array();
	$payload['graphY'] = array();
	$key = 0;
	foreach($dailyAverageResponse as $key=>$singleDate){
		$payload['graphX'][] = $key;
		$payload['graphY'][] = $singleDate;
	}

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
