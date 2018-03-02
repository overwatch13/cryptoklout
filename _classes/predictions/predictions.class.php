<?php


class Predictions extends Standards {
	function submitPrediction($info){
		$post = $info['post'];

		// data points
		$userId = $post['userId'];
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

	// This was being used on the homepage, but is not longer because the sql call is too complex, and needed to be its own call.
	function getPredictions($options = array()){
			// Available $options
			/*
				array(
					"get"=>6,
					"getFuture"=>true,
				)
			*/

			$optionsSet = 0; // used as a flag because first one needs WHERE, subsequent ones need and
			$whereAnd = "WHERE";

			if(sizeof($options)==0){
				$sql = "SELECT * FROM predictions_all_types ";
			}else{
				// write out the custom prediction search based on the options you want
				if(isset($options['getFuture'])){
					$optionsSet++;
					if($optionsSet>1){ $whereAnd = "AND"; }
					$sql .=  $whereAnd." expires > CURDATE() ";
				}
				if(isset($options['get'])){
					$optionsSet++;
					$sql .= " limit " . $options['get'];
				}
			}

			$query = $this->query($sql, 'fetch');
			//error_reporting(E_ALL);


	    $array = array(
			'sql'=>$sql,
			'query'=> $query,

			//'info'=>$info,
			//'userId'=>$userId,
			//'post'=>$post,
			//'coinSymbol'=>$coinSymbol,
		);

		return $array;
	}

	function getPredictionsHomepage(){
		// u = user
		// ucs = user_crypto_score
		// ui = user_info
		// pat = predictions_all_types
		$sql = "SELECT u.email, ";
		$sql .=" ucs.userId, ucs.cryptoScore, ";
		$sql .=" ui.first_name, ui.last_name, ui.picture, ";
		$sql .=" pat.id, pat.coinSymbol, pat.currencySymbol, pat.currentPrice, pat.predictedPrice, pat.percentageDifference, pat.reason, pat.timestamp, pat.predictionDays, pat.expires ";
    $sql .=" FROM user u, user_crypto_score ucs, user_info ui, predictions_all_types pat ";
    $sql .= " WHERE u.id = ucs.userId AND u.id = ui.userId AND u.id = pat.userId ";
		$sql .= " AND pat.expires > CURDATE() LIMIT 6 ";

		$query = $this->query($sql, 'fetch');
    $users = $query;

		$query = $this->query($sql, 'fetch');
		//error_reporting(E_ALL);


    $array = array(
		'sql'=>$sql,
		'query'=> $query,

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
