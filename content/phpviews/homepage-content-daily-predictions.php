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
    $pHtml .='<div class="pred-img-cont">';
    $pHtml .='<div class="predictor-img-rounded" data-userid="'.$pred["userId"].'">';  
    $pHtml .='<img src="/img/avatar-5.jpg" width="60" />';
    $pHtml .='</div>';
    $pHtml .='</div>';
    $pHtml .='<div class=""><span class="pred-hide-small">Prediction End: </span>'. date('m/d/Y', strtotime('+1 day')) .'</div>';
    $pHtml .='</div>'; // end clear
}

$pHtml .= "</div>";