<?php 

class PriceTrackingBtc extends Standards {
	function getLatestBtc(){
	    $sql = "SELECT * FROM price_tracking_btc ORDER BY timestamp DESC LIMIT 1";
    	$query = $this->query($sql, 'fetch');
	    	
	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
		);

		return $array;
	}

	function getBtcBetweenTimestamp($timeRange){
	   $sql = "SELECT * FROM price_tracking_btc as btc WHERE timestamp BETWEEN '".$timeRange['beginTime']."' AND '".$timeRange['endTime']."' ";
    	$query = $this->query($sql, 'fetch');
	    	
	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
		);

		return $array;
	}
	
}