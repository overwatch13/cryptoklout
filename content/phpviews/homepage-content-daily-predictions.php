<?php 

$predictionPath = $_SERVER['DOCUMENT_ROOT'] . "/_classes/predictions/predictions.class.php";
include $predictionPath;

$Predictions = new Predictions();
$rp = $Predictions->getPredictions();
$rp = $rp['query'];
// get the prediction data here, and run the logic in php instead of JS.

$pHtml = '<div class="hp-recent-prediction-container clear">';
//$rp as $key => $pred
for($i=0; $i<6; $i++){
    //$pHtml .='<div class=""></div>';
    $pHtml .='<div class="hp-recent-pred-single">';
	    $pHtml .='<ul class="list-group">';
	    	// image 
	    	$pHtml .='<li class="list-group-item">';
			$pHtml .='<div class="pred-img-cont">';
			    $pHtml .='<div class="predictor-img-rounded" data-userid="'.$rp[$i]["userId"].'">';  
			    	$pHtml .='<a href="/pages/predictor/2412.php"><img src="/img/avatar-5.jpg" width="60" /></a>';
			    $pHtml .='</div>';
		    $pHtml .='</div>';
	    	$pHtml .='</li>';
	    	// first line, coin symbol, current price
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Coin: </span> '.$rp[$i]["coinSymbol"].', Was: <span class="text-bold">$'.number_format($rp[$i]["currentPrice"]).'</span>, Will be: <span class="text-bold">$'. number_format($rp[$i]["predictedPrice"]).'</span>';
	    	if($rp[$i]["percentageDifference"]>0){
	    	 	$pHtml .=' <span class="text-success">('.$rp[$i]["percentageDifference"].'%)</span></li>'; 
	    	}else{
	    		$pHtml .=' <span class="text-danger">('.$rp[$i]["percentageDifference"].'%)</span></li>'; 
	    	}

	    	// second line, prediction
	    	$pHtml .='<li class="list-group-item">Predicted: '.date("m/d/Y", strtotime($rp[$i]["userSubmittedTimestamp"])).', Ends: '. date('m/d/Y', strtotime('+1 day')) .' ('.$rp[$i]["predictionDays"].' day prediction)</li>';
	    	if($rp[$i]["reason"] && $rp[$i]["reason"] !==""){
				$pHtml .='<li class="list-group-item">'. $rp[$i]["reason"] .'</li>';
	    	}
	    $pHtml .='</ul>';
    $pHtml .='</div>'; // end clear
}
$pHtml .= "</div>";
