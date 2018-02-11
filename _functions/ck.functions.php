<?php 

// this is our generic api function that I used in AT. we currently dont have an API but we can do it this way if we want in the future. 
function atFunctions($construct){
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
}


