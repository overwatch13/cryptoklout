<?php 

class ProcessPredictions extends Standards {
    
    // Not sure if this name applies correctly. Might not be like this. 
	function setReadyForProcessingFlag(){
	    // first step is to grab all of the items that are expired, and have process == 0 meaning it has not been processed yet. 
	    $sql = "SELECT * FROM predictions_all_types WHERE `expires` < CURDATE() AND processed = 0";

	    // in order to do the comparison, you will need to make sure that the data is available. Since your system went down, you need to see which date ranges are available.
    	$availableForProcessing = $this->query($sql, 'fetch');
    	
    	// so now we have an array of possible predictions to process against.
    	// the tricky part is, since they are different increments, how do we see if the btc price had exceeded the prediction price at any time between their prediction.
    	// You could do a sql statement for every single prediction, but this is quite inefficient, what would happen if there were thousands? 
    	// Would there ever be? Because technically, since this is running every day the number will always be smaller, you could even run this function twice a day to keep the numbers down.
    	// so yes you can go with the ineficient route. 
        /*[0] => Array
            (
                [id] => 8
                [userId] => 2
                [predictionName] => pred1
                [predictionDays] => 1
                [coinSymbol] => BTC
                [currencySymbol] => USD
                [currentPrice] => 11250.00
                [predictedPrice] => 11450.00
                [percentageDifference] => 1.78
                [reason] => feeling bullish
                [timestamp] => 2018-02-17 11:37:37
                [expires] => 2018-02-18 16:37:37
                [ready_for_processing] => 0
                [processed] => 0
            ), ... */
            
        foreach($availableForProcessing as &$prediction){
            // loop through them, get the dates, and make a new query. 
            // bring back the max and min of the numbers in between the BTC price dates. 
            // separate that as its own function. 
            $maxMin = $this->getMaxMinPredictionsToBtc($prediction);
            
            /* $prediction['comparisonResults'] = Array
            (
                [sql] => SELECT * FROM price_tracking_btc as btc WHERE btc.PRICE=(SELECT MAX(price_tracking_btc.PRICE) FROM price_tracking_btc WHERE timestamp BETWEEN '2018-02-16 13:03:19' AND '2018-02-17 16:37:37') 
                [results] => Array
                (
                    [0] => Array
                    (
                        [id] => 194
                        [PRICE] => 10875.56
                        .....
                    )

                )
            )*/
            
            // At this point you have returned an array of comparisonResultsm there should always be one record because you 
            // havnt actually done the comparison yet, youve just returned the MAX or MIN within a specific timeframe. 
            
            // So now is the time to compare and save. 
            if($maxMin && sizeof($maxMin['results']>0)){
        	     $prediction['processed'] = 1; 
        	     $prediction['closest_coin_tracking_id'] = $maxMin['results']['id']; // gives the id of the closest record that was found, could be max or min. We record it success or failure.
        	     $prediction['compare_price'] = $maxMin['results']['PRICE'];
        	     
        	    // different comparator operators, based on whether the prediction was positive or negative.
        	    if($prediction['percentageDifference']>0){
        	        //$prediction['test'] = 1;
        	        if($prediction['predictedPrice'] <= $maxMin['results']['PRICE']){
                        $prediction['prediction_succeeded'] = 1; // one of the btc prices exceeded your prediction, success!         
                        //$prediction['test'] = 2;
        	        }else{
        	            $prediction['prediction_succeeded'] = 0; 
        	            //$prediction['test'] = 3;
        	        }
        	    }else{
        	        //$prediction['test'] = 4;
                   if($prediction['predictedPrice'] >= $maxMin['results']['PRICE']){
                        $prediction['prediction_succeeded'] = 1; // one of the BTC prices was lower than your prediction, success!
                        //$prediction['test'] = 5;
        	        }else{
        	            $prediction['prediction_succeeded'] = 0; 
        	            //$prediction['test'] = 6;
        	        }         	        
        	    }
        	    
        	    // Update the prediction with some information about the results that came back.
        	    $updateSql = "UPDATE predictions_all_types SET processed=".$prediction['processed'].", closest_coin_tracking_id=".$prediction['closest_coin_tracking_id'].", compare_price=".$prediction['compare_price'].", prediction_succeeded=".$prediction['prediction_succeeded']." ";
                $updateSql .= " WHERE id=".$prediction['id'];
                $prediction['updateSql'] = $updateSql;
                $this->query($updateSql);
            }
            
            $prediction['comparisonResults'] = $maxMin; // for testing purposes only. Good to see the returned array in the view. // http://cryptoklout.com/jobs/process-past-predictions.php
        }// end foreach loop
    	
	    	
	    $array = array(
			'sql'=>$sql,
			'availableForProcessing'=> $availableForProcessing,
		);

		return $array;
	}
	
	function getMaxMinPredictionsToBtc($prediction){
	    // new sql statement to run 
	    // We can reduce the search by 50% by looking seeing if the prediction is positive or negative. 
	    $positive = false;
	    if($prediction['percentageDifference']>0){
	        $positive = true;
	    }
	    
	    // this looks for the maximum or minimum amount within a given time frame, technically this is not comparing anything so it should being back a result regardless. 
	    if($positive){
	       $sql = "SELECT * FROM price_tracking_btc as btc WHERE btc.PRICE=(SELECT MAX(price_tracking_btc.PRICE) FROM price_tracking_btc WHERE timestamp BETWEEN '".$prediction['timestamp']."' AND '".$prediction['expires']."') ";
	    }else{
	       $sql = "SELECT * FROM price_tracking_btc as btc WHERE btc.PRICE=(SELECT MIN(price_tracking_btc.PRICE) FROM price_tracking_btc WHERE timestamp BETWEEN '".$prediction['timestamp']."' AND '".$prediction['expires']."') ";
	    }
	    
	    $results = $this->query($sql, 'fetch');
        
        // If the MAX or MIN is tied between one or more values it will return both of them! So you need to only take 1.
	    if(sizeof($results)>0){ // do a check so we dont hit an error.
	        $results = $results[0];
	    }
	    
	    $array = array(
			'sql'=>$sql,
			'results'=> $results,
		);
	    
	    return $array;
	}
	
}