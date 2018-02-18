<?php 
// Just get the simplest version working and than extend this out to be more prolific horizontally.
// We do not want to be including all of the classes here, instead we want to reference the files directly and the router be super generic. 
include ROOT . "_classes/predictions/predictions.class.php";

function ckRouter($info){
	// for right now we are going to only implement the first function, but this should be super generic function that works for all. 
	$Predictions = new Predictions();
	//$return = $info;
	$return = $Predictions->submitPrediction($info);

	return $return;

}


// this is our generic api function that I used in AT. we currently dont have an API but we can do it this way if we want in the future. 
/*function ckFunctions($construct){
	if($construct){
		$view = new AT($construct, false);
		// array passed in.
		$result = $view->performATFunction($construct);

		// This was part of the 25%, 50%, 100% business plan. no longer using. 
		if(isset($construct['manipulate']) && function_exists($construct['manipulate'])){
			$function = $construct['manipulate']; // within ajax Call, we passed in the function name, 'manipulate' => 'limitData', so $function = limitData
			$result = $function($result);
		}
	}
	else {
		// Issue some kind of error
		$result = array();
	}

	return $result;
}*/


