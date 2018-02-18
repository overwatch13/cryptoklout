<?php 

class PriceTrackingBtc extends Standards {
	function getLatestBtc(){
	    $sql = "SELECT * FROM pricetrackingbtc ORDER BY timestamp DESC LIMIT 1";
    	$query = $this->query($sql, 'fetch');
	    	
	    $array = array(
			'query'=> $query,
			'sql'=>$sql,
		);

		return $array;
	}
	
}