<?php include ROOT . "content/predictions/predictions-content-choose-timing-logic.php"; 

// echo "<pre style='font-size:10px;'>";
// print_r($uiVars);
// echo "</pre>";

?>

<style>
    /* move these to css/less/pages/predictions-prediction-choice-page.less  later on */
    .prediction-choices-container a.disabled .prediction-choice{
        background:#afafaf;
        cursor:default;
    }
</style>

<section>
	<div class="container">
	<div class="row">
		<div class="col">
			<div class="prediction-choices-container">
			    <?php echo $finalButtons; ?>
			</div>
			<p style="margin-top:30px;">Once you make a prediction, you will not be able to make another prediction of the same type until that time frame has expired. ie; If you make a 3 day prediction, you will not be able to make another 3 day prediction until 3 days from now.</p>

			<p style="margin-top:15px;">Tip: a string of consesutive correct predictions can yield more points and thus climb the rankings faster.</p>
		</div>
	</div>
</div>
</section>
