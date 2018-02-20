<?php 
// /jobs/process-past-predictions.php
// Purpose: look through expired predictions, and process them as success or not.


if(empty($_SERVER['DOCUMENT_ROOT'])){ // test to see if linux server is reading it.
    chdir("/home/cryptoklout/public_html/jobs/");
}

//echo getcwd() . "\n";

include  "../config.php"; 
include ROOT . "_classes/pastPredictionProcessing/processPredictions.class.php"; 

$processPredClass = new ProcessPredictions();
$available = $processPredClass->setReadyForProcessingFlag();


echo "<pre>";
print_r($available);
echo "</pre>";

?>
