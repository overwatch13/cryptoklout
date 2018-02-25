<?php include ROOT . "content/prediction/content-proof-php-logic.php"; ?>
<script>
    var payload = <?php echo json_encode($payload); ?>;
</script>


<section>
    <?php if($runPage): /* Case when the php has found some prediction information. */ ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Prediction</h3>
                <div class="chart-container" style="position: relative; max-width:700px;">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    	<div class="row" style="margin-top:30px;">
    		<div class="col">
                <div id="js-predictionInfo"></div>
    		</div>
    	</div>
        <div class="row" style="margin-top:30px;">
            <div class="col">
                <h3>Predictor information</h3>
                <p>Grab some info about the user and some stats and show high level stuff here. Will link to their profile page. </p>
            </div>
        </div>

    </div>

    <?php else: /* If the page cannot find the prediction it will display this message. */  ?>
    <div class="container">
        <div class="row">
            <div class="col">
               <h4>We could not find that prediction.</h4>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
