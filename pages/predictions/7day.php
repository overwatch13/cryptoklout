<?php
$tabActive = "";
//$cssSpecific = array('less/homepage.css');
$GLOBALS['contentPathRootUnique'] = "predictions/";
$contentDisplay = "prediction-form-content.php";
$requireJsInitializer = "/js/pages/predictions/app-prediction-form.js"; // loads the specific starting script you want in the footer. SECTION Specific

// page specific php Variables in order to differentiate between the various prediction forms. 
$predName = "pred7";
$predDaysFuture = 7;
$predH1 = "1 Week Prediction";


include '../../shell-root.php'; 
