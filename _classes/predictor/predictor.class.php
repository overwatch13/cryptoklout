<?php 
class Predictor extends Standards {
	// gets all predictions for that user.
	function getPredictorPredictions($userId){
	    $sql = "SELECT * FROM predictions_all_types WHERE userId = ".$userId." AND processed = 1";
    	$query = $this->query($sql, 'fetch');
	    	
	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
		);
		return $array;
	}

	// gets all of the predictors information. We dont have a table for this yet. 
	function getPredictorPersonalInformation($userId){
	    /*$sql = "SELECT * FROM predictions_all_types WHERE userId = ".$userId." AND processed = 1";
    	$query = $this->query($sql, 'fetch');*/
	    	
	    $array = array(
			'query'=> "Personal Info table does not exist yet, will be here soon import all of their data here.",
			//'sql'=>$sql,
		);
		return $array;
	}
}