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
		
		// ", coinSymbol, currencySymbol, currentPrice, predictedPrice, percentageDifference, reason"
		$columnNames = "userId, predictionName, predictionDays, coinSymbol, currencySymbol, currentPrice, predictedPrice, percentageDifference, reason";

		// make sure string values have quotes around them ''
		$values = $userId.", '".$predictionName."', ".$predictionDays.", '".$coinSymbol."', '".$currencySymbol."', ".$currentPrice.", ".$predictedPrice.", ".$percentageDifference.", '".$reason."'"; // .", ".
		
		$sql = "INSERT INTO predictionsSingleDay (".$columnNames.") VALUES(".$values.")";

		$query = $this->query($sql);

		$array = array(
			'query'=> $query,
			//'sql'=>$sql,
			//'info'=>$info,
			//'userId'=>$userId,
			//'post'=>$post,
			//'coinSymbol'=>$coinSymbol,
		);

		return $array;
	}
	
	function getPredictions(){
	    $sql = "SELECT * FROM predictionsSingleDay";
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