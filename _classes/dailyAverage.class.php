<?php 

class DailyAverage extends Standards {
	function createDailyAverage($coinArr){
		$newArr = array();
		foreach($coinArr as $key=>$spec){ // spec if an object with all of the btc info for a single call. {id, price, volume etc}
			//$newArr[] = $spec['PRICE'];
			// convert "2012-07-24 11:52:01" to "2012-07-24"
			$dt = new DateTime($spec['timestamp']);
			$regDt = $dt->format('m-d-Y');
			// create a sub array for that date, the key will be the date and will be unique so there is only 1 array per day.
			if(!isset($newArr[$regDt])){ // if the array does not exist for that key, than make one
				$newArr[$regDt] = array($spec['PRICE']);
			}else{
				// otherwise the array exists, so just add into the sub array for that date.
				$newArr[$regDt][] = $spec['PRICE'];
			}
		}

		// We need to sort the $newArr in case the dates are out of alignment. 
		ksort($newArr);

		// now $newArr is an arr with keys of each day, and values inside of all the prices, so loop through and take the average. 
		$averageArr = array();
		foreach($newArr as $singleDay=>$arrOfPrices){ // spec if an object with all of the btc info for a single call. {id, price, volume etc}
			$totalPrices = 0;
			foreach($arrOfPrices as $priceKey=>$price){ 
				$totalPrices += $price;
			}
			
			// to prevent errors incase.
			if($totalPrices !=null && $totalPrices>0){
				// divides total by the amount of prices that are in the single date arr.  
				$average = round(($totalPrices / sizeof($arrOfPrices))); 
			}else{
				$average = 0; 
			}
			$averageArr[$singleDay] = $average;
		}


		return $averageArr;
		//return $averageArr;
	}
}