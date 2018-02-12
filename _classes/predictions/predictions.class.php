<?php 

/* INVENTORY

submitPrediction

*/

class Predictions extends Standards {
	function submitPrediction($info){
		$post = $info['post'];
		$predictionName = $info['function'];
		$userId = $info['userId'];
		
		// data points
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
			'sql'=>$sql,
			//'info'=>$info,
			//'userId'=>$userId,
			//'post'=>$post,
			//'coinSymbol'=>$coinSymbol,
		);

		return $array;
	}
}