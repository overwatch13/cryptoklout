<?php 


class Predictions extends Standards {
	function submitPrediction($info){
		$post = $info['post'];
		$userId = $info['userId'];
		// data points
		$predictionName = $post['predictionName'];
		$predictionDays = $post['predictionDays'];
		$coinSymbol = $post['coinSymbol'];
		$currencySymbol = $post['currencySymbol'];
		$currentPrice = $post['currentPrice'];
		$predictedPrice = $post['predictedPrice'];
		$percentageDifference = $post['percentageDifference'];
		$reason = $post['reason'];
		
		// calculated field based on current timestamp, and than we calculate the future expire date.
	    $today = date("Y-m-d H:i:s");
        $stringFutureDays = $today." +".$predictionDays." days";
        $expires = date("Y-m-d H:i:s", strtotime($stringFutureDays));
		
		// ", coinSymbol, currencySymbol, currentPrice, predictedPrice, percentageDifference, reason"
		$columnNames = "userId, predictionName, predictionDays, coinSymbol, currencySymbol, currentPrice, predictedPrice, percentageDifference, reason, expires"; // , 
		// make sure string values have quotes around them ''
		$values = $userId.", '".$predictionName."', ".$predictionDays.", '".$coinSymbol."', '".$currencySymbol."', ".$currentPrice.", ".$predictedPrice.", ".$percentageDifference.", '".$reason."', '". $expires."'"; 
		$sql = "INSERT INTO predictions_all_types (".$columnNames.") VALUES(".$values.")";
		$query = $this->query($sql);

        // *** Second Query update the predictor_timing_limitations table for the user ***/
        $timingSql = "UPDATE predictor_timing_limitations SET ".$predictionName."='".$expires."' WHERE userId=".$userId." ";
        $queryTiming = $this->query($timingSql);

		$array = array(
			'query'=> $query,
			'sql'=>$sql,
			//'info'=>$info,
			//'userId'=>$userId,
			//'post'=>$post,
			//'coinSymbol'=>$coinSymbol,
		);

		return $array;
	}
	
	function getPredictions(){
	    $sql = "SELECT * FROM predictions_all_types";
    	$query = $this->query($sql, 'fetch');
	    	
	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
			//'info'=>$info,
			//'userId'=>$userId,
			//'post'=>$post,
			//'coinSymbol'=>$coinSymbol,
		);

		return $array;
	}

	function getPredictionSingle($predictionId){
	    $sql = "SELECT * FROM predictions_all_types where id = ".$predictionId." ";
    	$query = $this->query($sql, 'fetch');
	    	
	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
			//'info'=>$info,
			//'userId'=>$userId,
			//'post'=>$post,
			//'coinSymbol'=>$coinSymbol,
		);

		return $array;
	}
	
}