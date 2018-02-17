<?php 

include $_SERVER['DOCUMENT_ROOT'] . "/_classes/standards.class.php";
$predictionPath = $_SERVER['DOCUMENT_ROOT'] . "/_classes/predictions/predictions.class.php";
include $predictionPath;

$Predictions = new Predictions();
$rp = $Predictions->getPredictions();
$rp = $rp['query'];
// get the prediction data here, and run the logic in php instead of JS.

$pHtml = '<div class="hp-recent-prediction-container">';
foreach($rp as $key => $pred){
    //$pHtml .='<div class=""></div>';
    $pHtml .='<div class="hp-recent-pred-single clear">';
	    
	    $pHtml .='<ul class="list-group">';
	    	$pHtml .='<li class="list-group-item">';
				$pHtml .='<div class="pred-img-cont">';
				    $pHtml .='<div class="predictor-img-rounded" data-userid="'.$pred["userId"].'">';  
				    	$pHtml .='<img src="/img/avatar-5.jpg" width="60" />';
				    $pHtml .='</div>';
			    $pHtml .='</div>';
	    	$pHtml .='</li>';
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Coin: </span>'. $pred["coinSymbol"].', '.$pred["currencySymbol"].'</li>';
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Prediction: </span>'. $pred["predictedPrice"] .', '.$pred["percentageDifference"].'%</li>';
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Prediction Start - End: </span>'. date('m/d/Y', strtotime('-1 day')) .' - '. date('m/d/Y', strtotime('+1 day')) .'</li>';
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Reason: </span>'. $pred["reason"] .'</li>';

	    $pHtml .='</ul>';
    $pHtml .='</div>'; // end clear
}

$pHtml .= "</div>";