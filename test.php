<?php 

$predictionDays = 2;
$today = date("Y-m-d H:i:s");
$stringFutureDays = $today." +".$predictionDays." days";
$expires = date("Y-m-d H:i:s", strtotime($stringFutureDays));

// date("Y-m-d H:i:s") is the numeric equivalent to the date time that mysql timestamp should have 
echo $today ."<br/>";
echo $stringFutureDays ."<br/>";
echo $expires;