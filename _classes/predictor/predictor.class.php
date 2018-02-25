<?php
class Predictor extends Standards {
	// gets all predictions for that user.
	function getPredictorPredictions($userId){
	    $sql = "SELECT * FROM predictions_all_types WHERE userId = ".$userId." ";
    	$query = $this->query($sql, 'fetch');

	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
		);
		return $array;
	}

	// gets all of the predictors information. We dont have a table for this yet.
	function getPredictorPersonalInformation($userId){
	    $sql = "SELECT * FROM user WHERE id = ".$userId." ";
    	$query = $this->query($sql, 'fetch');

	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
		);
		return $array;
	}
}
