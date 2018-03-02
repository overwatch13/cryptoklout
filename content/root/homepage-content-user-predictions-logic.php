<?php
include ROOT . "_classes/predictions/predictions.class.php";

$Predictions = new Predictions();
$rpResponse = $Predictions->getPredictionsHomepage();
$rp = $rpResponse['query'];
// get the prediction data here, and run the logic in php instead of JS.


// echo "<pre style='font-size:11px;'>";
// echo print_r($rpResponse);
// echo "</pre>";

$pHtml = ''; //'<div class="hp-recent-prediction-container clear">';
//$rp as $key => $pred
for($i=0; $i<sizeof($rp); $i++){
	if(isset($rp[$i]["userId"])) {
		// If the increment is 0 or even, than make it its own row.
		if($i==0 || ($i % 2==0)){
			$pHtml .= '<div class="row" style="margin-top:20px;">';
		}
		//$pHtml .='<div class=""></div>';
		$pHtml .='<div class="col-sm-12 col-md-12 col-lg-6 hp-recent-pred-single" data-test='.$i.'>';
		$pHtml .='<ul class="list-group">';

		// Header li
		$pHtml .='<li class="list-group-item clear">';
		// display picture if it exists.
		if($rp[$i]["picture"]){
		$pHtml .='<div class="pred-img-cont">';
		$pHtml .='<div class="predictor-img-rounded">';
		$pHtml .='<a href="/predictor/'.$rp[$i]["userId"].'"><img src="'.$rp[$i]["picture"].'" width="60" /></a>';
		$pHtml .='</div>';
		$pHtml .='</div>'; // end .pred-img-cont
		}

		// Display their first and last name if it exists.
		if($rp[$i]["first_name"] && $rp[$i]["last_name"]){
		$pHtml .='<div class="predictor-info-block">';
		$pHtml .='<a href="/predictor/'.$rp[$i]["userId"].'"><div class="">'.$rp[$i]["first_name"].' '.$rp[$i]["last_name"].'</div></a>';
		$pHtml .='<div class="pred-details"><a href="/prediction/'.$rp[$i]["id"].'">Prediction Details</a></div>';
		$pHtml .='</div>';
		}
		$pHtml .='</li>'; // end header li

		// first line, coin symbol, current price
		$pHtml .='<li class="list-group-item"><span class="pred-hide-small">Coin: </span> '.$rp[$i]["coinSymbol"].', Was: <span class="text-bold">$'.number_format($rp[$i]["currentPrice"]).'</span>, Will be: <span class="text-bold">$'. number_format($rp[$i]["predictedPrice"]).'</span>';
		if($rp[$i]["percentageDifference"]>0){
		$pHtml .=' <span class="text-success">('.$rp[$i]["percentageDifference"].'%)</span></li>';
		}else{
		$pHtml .=' <span class="text-danger">('.$rp[$i]["percentageDifference"].'%)</span></li>';
		}

		// second line, prediction
		$pHtml .='<li class="list-group-item">Predicted: '.date("m/d/Y", strtotime($rp[$i]["timestamp"])).', Ends: '. date('m/d/Y', strtotime('+1 day')) .' ('.$rp[$i]["predictionDays"].' day prediction)</li>';
		if($rp[$i]["reason"] && $rp[$i]["reason"] !==""){
		$pHtml .='<li class="list-group-item">'. $rp[$i]["reason"] .'</li>';
		}
		$pHtml .='</ul>';
		$pHtml .='</div>';

		if($i & 1){ //($i == 0) ||
			$pHtml .= '</div>';
		}
}
}
$pHtml .= "</div>";
