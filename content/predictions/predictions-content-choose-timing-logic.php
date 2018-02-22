<?php 
include ROOT . "_classes/predictions/predictions-choose.class.php"; 
$userId = 2; // fill this with dynamic information after you get login working.
$PredictionTimeLimitationsClass = new PredictionTimeLimitations();
$timingResponse = $PredictionTimeLimitationsClass->getPredictorTimeLimitations($userId);
$timing_limitations = $timingResponse['query'][0];
unset($timing_limitations['userId']); // remove the userId from the array since it is not needed for the comparison iterator.

/*echo "<pre style='font-size:10px;'>";
print_r($timing_limitations);
echo "</pre>";*/

$today = date("Y-m-d H:i:s");
$uiVars = array(); // storage for the ui, disabled boolean and messag to display. 

// Calculate the timing difference, and boolean leave this open ended enough so that the 1day, 3day, ... pages can use the logic as well, since you need to protect those pages. 
foreach($timing_limitations as $key=>$limitationTime){
   $timeDifference = strtotime($today) - strtotime($limitationTime);
   $response = "";

   if($timeDifference < 0){
       $availabilityBoolean = 0;
       // this means that the number is negative because expire time is greater than todays date.
       // convert the number into days and hours, and if there is not a full day only display hours. 
       // should we have sentences for each type like "Available in 1 hour etc", would require quite a bit of if than logic. 
       $timeDifference = abs($timeDifference);
       $timeDifferenceMinutes = ($timeDifference / 60); // divide by 60 seconds.
       $timeDifferenceHours = ($timeDifferenceMinutes / 60); // divide giving hours.
       $timeDifferenceDays = ($timeDifferenceHours / 24); // divide to give days

       if($timeDifferenceDays>1){
            $response = "Available in ".round($timeDifferenceDays, 1)." days"; 
            
       }else if($timeDifferenceDays <= 1){
           $response = "Available in ".round($timeDifferenceHours, 1)." hours"; 
           //$respond = true; 
       }
       
       //echo $timeDifference . "<br/>";
       //echo $response . "<br/>";
       //echo "not available <br/><br/>";
   }else{
       
       // the number is positive, which means the todays time is greater than than expiration time so it is available!
       //echo $timeDifference . "<br/>";
       //echo "available <br/><br/>";
       $availabilityBoolean = 1;
       $response = "Available";
   }
   
   // add to $uiVars to paint proper ui.
   $uiVars[$key] = array(
       "response"=>$response,
       "availabilityBoolean"=>$availabilityBoolean
       );
}

// Now create the UI directly in PHP, so the logic can be applied, and it is instantaneous load. 
$finalButtons = "";
foreach($uiVars as $stone=>$predSingle){
    switch ($stone){ // gives "pred1" or "pred3"
        case "pred1":
            $predTitle = "1 Day";
            $predUrl = "/pages/predictions/1day.php";
            break;
        case "pred3":
            $predTitle = "3 Day";
            $predUrl = "/pages/predictions/3day.php";
            break;
        case "pred7":
            $predTitle = "7 Day";
            $predUrl = "/pages/predictions/7day.php";
            break;
        case "pred14":
            $predTitle = "14 Day";
            $predUrl = "/pages/predictions/14day.php";
            break;
        case "pred30":
            $predTitle = "30 Day";
            $predUrl = "/pages/predictions/30day.php";
            break;
        case "pred90":
            $predTitle = "90 Day";
            $predUrl = "/pages/predictions/90day.php";
            break;
    }
    if($predSingle['availabilityBoolean']){
        $finalButtons .='<a href="'.$predUrl.'">';
            $finalButtons .='<div class="prediction-choice">';
                $finalButtons .='<div class="text-large">'.$predTitle.'</div>';
                $finalButtons .='<div class="text-small">Prediction</div>';
                $finalButtons .='<div class="availability text-success">'.$predSingle['response'].'</div>';
            $finalButtons .='</div>';
        $finalButtons .='</a>';
    }else{
        $finalButtons .='<a class="disabled">';
            $finalButtons .='<div class="prediction-choice">';
                $finalButtons .='<div class="text-large">'.$predTitle.'</div>';
                $finalButtons .='<div class="text-small">Prediction</div>';
                $finalButtons .='<div class="availability text-danger">'.$predSingle['response'].'</div>';
            $finalButtons .='</div>';
        $finalButtons .='</a>';
    }
}
























