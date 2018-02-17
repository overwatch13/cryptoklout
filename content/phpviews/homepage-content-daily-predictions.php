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
				    	$pHtml .='<a href="/pages/predictor/2412.php"><img src="/img/avatar-5.jpg" width="60" /></a>';
				    $pHtml .='</div>';
			    $pHtml .='</div>';
	    	$pHtml .='</li>';
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Coin: </span>'. $pred["coinSymbol"].'</li>';
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Prediction: </span>$'. $pred["predictedPrice"] .', '.$pred["percentageDifference"].'%</li>';
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Prediction Start - End: </span>'. date('m/d/Y', strtotime('-1 day')) .' - '. date('m/d/Y', strtotime('+1 day')) .'</li>';
	    	$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Reason: </span>'. $pred["reason"] .'</li>';

	    $pHtml .='</ul>';
    $pHtml .='</div>'; // end clear

    

}
$pHtml .= "</div>";

// The below is the table view for the larger format. Only the top or bottom will display. 
/*$pWideHtml ='<table class="table">';
$pWideHtml .='<thead>';
$pWideHtml .='<th>Predictor</th>';
$pWideHtml .='<th>Coin / currency</th>';
$pWideHtml .='<th>Predicted Price</th>';
$pWideHtml .='<th>% diff</th>';
$pWideHtml .='<th>Reason</th>';
$pWideHtml .='<th>Predictor Accuracy</th>';
$pWideHtml .='</thead><tbody>';

foreach($rp as $key => $pred){
$pWideHtml .= "<tr>";
$pWideHtml .= '<td><div class="predictor-img-rounded cursor-pointer" data-userid="'.$pred['userId'].'"><img src="/img/avatar-5.jpg" width="60"/></div></td>';
$pWideHtml .= '<td>'.$pred['coinSymbol'].' / .'+$pred['currencySymbol'].'</td>';
$pWideHtml .= '<td>'.$pred['predictedPrice'].'</td>';
$pWideHtml .= '<td>'.$pred['percentageDifference'].'</td>';
$pWideHtml .= '<td>'.$pred['reason'].'</td>';
$pWideHtml .= '<td></td>';
$pWideHtml .= '</tr>';
}

$pWideHtml .='</tbody><table>';*/