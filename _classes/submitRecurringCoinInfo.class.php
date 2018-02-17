<?php 

class SubmitRecurringCoinInfo extends Standards {
	
	function submitBTC($payload){
	    //$payload = $post['payload'];
	    $columnNames = "";
	    $values = "";
	    // loop through the payload, and submit all of the key values, exception is when one of them is a string. 
	    foreach($payload as $key => $value){
	        // we are skipping some of the data, so anypropeties you dont want include here.
	        if($key == "TYPE" || $key == "MARKET" || $key == "FLAGS"){
	            // do nothing/
	        }else{
	            // we want the property. 
	           $columnNames .= $key . ", ";
                if($key == "FROMSYMBOL" || $key == "TOSYMBOL" || $key == "LASTMARKET"){
                    // since the value is a string surround in quotes. I tried detecting whether it was a string and it thinks they are all strings, but fails on mysl side. 
                    $values .= "'".$value . "', ";
                }else{
                    $values .= $value . ", ";
                } 
	        }
        }
	    
	    // Remove the last ", " from the end of both strings. 
	    $columnNames = substr($columnNames, 0, -2);
	    $values = substr($values, 0, -2);
	    
		$sql = "INSERT INTO priceTrackingBTC (".$columnNames.") VALUES(".$values.")";
		$query = $this->query($sql);

		$array = array(
			//'query'=> $query,
			'sql'=>$sql,
			'payload'=>$payload,
			//'stringCounter'=>$stringCounter,
		);

		return $array;
	}
}


// it thinks all of the values are strings, not sure how this will work out with the db. maybe the db just puts it to the correct type automatically. 
// $stringCounter = 0;
/* if(is_string($value)){
    $stringCounter++;
}*/