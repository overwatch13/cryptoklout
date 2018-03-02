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

	// $sql = "SELECT u.email, ";
	// $sql .=" ucs.userId, ucs.cryptoScore, ";
	// $sql .=" ui.first_name, ui.last_name, ui.picture, ";
	// $sql .=" pat.id, pat.coinSymbol, pat.currencySymbol, pat.currentPrice, pat.predictedPrice, pat.percentageDifference, pat.reason, pat.timestamp, pat.predictionDays, pat.expires ";
	// $sql .=" FROM user u, user_crypto_score ucs, user_info ui, predictions_all_types pat ";
	// $sql .= " WHERE u.id = ucs.userId AND u.id = ui.userId AND u.id = pat.userId ";

	// gets all of the predictors information. We dont have a table for this yet.
	function getPredictorPersonalInformation($userId){
	    $sql = "SELECT u.id, ui.first_name, ui.last_name, ui.picture, ucs.cryptoScore ";
			$sql .=" FROM user u, user_crypto_score ucs, user_info ui ";
			$sql .= " WHERE u.id = ucs.userId AND u.id = ui.userId ";
			$sql.=" AND u.id = ".$userId." ";

    	$query = $this->query($sql, 'fetch');

	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
		);
		return $array;
	}
}
