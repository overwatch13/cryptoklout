<?php 

include ROOT . "_classes/predictor/predictor.class.php";
$userId = 2; // fill this with dynamic information after you get login working. 
$predictorClass = new Predictor();
$predictorInfo = $predictorClass->getPredictorPredictions($userId);
$predictorPredictions = $predictorInfo['query'];

$masterArr = array();
// Iterate through the data and create separate arrays for each of the time frames, 
// allowing you to easily manipulate the data in JS. this would be a good opportunity to work with react on this one. 
foreach($predictorPredictions as $key=>$prediction){
    $masterArr[$prediction['predictionName']][] = $prediction; // creates a new array for each of the types. 
}