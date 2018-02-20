<?php 
class Predictor extends Standards {
	function getPredictorPredictions($userId){
	    $sql = "SELECT * FROM predictions_all_types WHERE userId = ".$userId." AND processed = 1";
    	$query = $this->query($sql, 'fetch');
	    	
	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
		);
		return $array;
	}
}