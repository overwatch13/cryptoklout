<?php
// *** Includes ***
include ROOT . "_classes/predictor/predictor.class.php"; // Predictor() class

$idFound = false;
$predictorFound = false;
$masterArr = array(
	"pastPredictions"=>"",
	"futurePredictions"=>"",
	"predictionsRawData"=>array(),
	"correctPercent"=>0,
); // rename this, but currently used for storing all predictions.
$processedTotal = 0; // used to calculate the % correct.
$predictionSucceeded = 0; // used to calculate the % correct.

//  ***** SOME OF THIS LOGIC SHOULD BE EXTRACTED INTO THE NIGHTLY JOB
// THIS WAY IT CAN SIMPLY BE CALLED FROM A TABLE FOR OTHER VIEWS. THIS WAY YOU DONT NEED TO CALCULATE IT OVER AND OVER AGAIN.

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


	// allowing you to easily manipulate the data in JS. this would be a good opportunity to work with react on this one.

	foreach($predictorPredictions as $key=>$prediction){
			// Iterate through the data and create separate arrays for each of the time frames,
			//$masterArr['predictionsSeparated'][$prediction['predictionName']][] = $prediction; // creates a new array for each of the types.

			// add every prediction to the master arr.
			$masterArr['predictionsRawData'][] = $prediction;
			createSingleProfilePredictionBlock($prediction); // create some html

			// gets totals for processed and succeeded to calculate the percentage correct.
			if($prediction['processed']){
				$processedTotal++;
				if($prediction['prediction_succeeded']){
					$predictionSucceeded++;
				}
			}
	} // end main foreach loop, goes through all predictions.

	// calculate the percentage correct.
	if($processedTotal>0){
		$masterArr['correctPercent'] = round((($predictionSucceeded/$processedTotal)*100),1);
	}

} // end if check


// Crete a single prediction block on the profile page.
function createSingleProfilePredictionBlock($prediction){
	global $masterArr;
	$predictionListHtml = "";
	$predictionListHtml .= '<a class="date-box-container" href="/prediction/'.$prediction['id'].'">';
	$predictionListHtml .= '<div class="color-coded '.($prediction['percentageDifference']>0 ? "bg-success" : "bg-danger").'">';
	// dictates whether they predicted up or down.
	$predictionListHtml .= '<span class="days-text">'.$prediction['predictionDays'].'d</span><i class="fas fa-long-arrow-alt-right '.($prediction['percentageDifference']>0 ? "up" : "down").'"></i>';
	$predictionListHtml .= '</div>'; // end .color-coded
	$predictionListHtml .= '<div class="date-container">';
	$predictionListHtml .= '<span class="">W: $'.number_format($prediction['currentPrice']).'</span><span class=""> T: $'.number_format($prediction['predictedPrice']).'</span>';
	$predictionListHtml .= '<span class="">P: '.$prediction['percentageDifference'].'%</span>';
	//$predictionListHtml .= '<div class="">M: '.date("n/j/y", strtotime($prediction['timestamp'])).'</div>';
	//$predictionListHtml .= '<div class="">E: '.date("n/j/y", strtotime($prediction['expires'])).'</div>';

	if($prediction['processed']){
		$predictionListHtml .= '<div class="results-container '.($prediction['prediction_succeeded']>0 ? "success" : "failed").'">'.($prediction['prediction_succeeded']>0 ? "Success" : "Missed").'</div>';
	}
	$predictionListHtml .= '</div>'; // end .date-container
	$predictionListHtml .= '</a>';

	if($prediction['processed']){
		// so if it was processed, than it is a past predictionName
		$masterArr['pastPredictions'] .= $predictionListHtml;
	}else{
		$masterArr['futurePredictions'] .= $predictionListHtml;
	}
}

// UNUSED
// if($prediction['processed']){
//
// }else{
// 	// if it has not been procseed it is in the future, put no color.
// 	$predictionListHtml .= '<div class="color-coded">';
// }
