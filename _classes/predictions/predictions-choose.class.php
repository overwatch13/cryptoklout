<?php

class PredictionTimeLimitations extends Standards {
	function getPredictorTimeLimitations($userId){
	   $sql = "SELECT * FROM predictor_timing_limitations WHERE userId = ".$userId." ";
    	$query = $this->query($sql, 'fetch');
	    	
	    $array = array(
			'query'=> $query,
			'sqll'=>$sql,
		);

		return $array;
	}
}