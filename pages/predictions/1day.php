<?php
$tabActive = "";
//$cssSpecific = array('less/homepage.css');
$GLOBALS['contentPathRootUnique'] = "predictions/";
$contentDisplay = "prediction-form-content.php";
$requireJsInitializer = "/js/pages/predictions/app-prediction-form.js"; // loads the specific starting script you want in the footer. SECTION Specific

// page specific php Variables in order to differentiate between the various prediction forms. 
$predName = "pred1";
$predDaysFuture = 1;
$predH1 = "Single Day Prediction";


include '../../shell-root.php'; 
