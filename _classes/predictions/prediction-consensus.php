<?php

// This class wont need these includes when you run it from the predictions.class.php, that would cause an infinite loop.
// you included them here because you are accessing this url directly via. 
// http://cryptoklout.com/_classes/predictions/prediction-consensus.php  for direct logic testing. 
require_once $_SERVER['DOCUMENT_ROOT'] . "/_classes/predictions/predictions.class.php"; // new Predictions(); 

class PredictionConsensus extends Standards {
    function getPredictionData(){
        $Predictions = new Predictions(); 
        $info = $Predictions->getPredictions(); // this simply gets the data to work with. this is not were the logic is. 
        return $info;
    }
    
    function calculatePredictionConsensus($info){
        $totalPrice; // aggregate of all the prediction prices combined.
        $arraySize = sizeof($info);
        
        foreach($info as $key => $prediction){
            $totalPrice += $prediction['predictedPrice'];    
        }
        
        $averagePredictedPrice = $totalPrice / $arraySize;
        
        $return = array(
            'predictedAverage' =>  $averagePredictedPrice
        );
        
        return $return;
    }
    
    function getPredictionConsensus(){
	    $info = $this->getPredictionData(); // comes back as array of arrays, each sub array contains single prediction info
	    $query = $info['query'];  // access the query of it. [prediction, ...]
	    $consensusCalculated = $this->calculatePredictionConsensus($query);
		return $consensusCalculated;
	}
}

?>

<!-- turn thion if you are doing direct logic testing. -->
<?php 
/*echo "<pre>";
$PC = new PredictionConsensus();
$data = $PC->getPredictionConsensus();
print_r($data);
echo "</pre>";*/
?>
