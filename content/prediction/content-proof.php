<?php include ROOT . "content/prediction/content-proof-php-logic.php"; ?>
<script>
    var predictionInfo = <?php echo json_encode($predictionSingleData); ?>;
    var predictorPersonalInfo = <?php echo json_encode($predictorPersonalInfo); ?>;
    var btcRangeIncrementsArr = <?php echo json_encode($priceTrackingRangeArr); ?>;
</script>


<section>
    <?php if($runPage): /* Case when the php has found some prediction information. */ ?>
    <div class="container">
    	<div class="row">
    		<div class="col">
    			<div class="graph-container">Graph showing the relative prediction time and prediction</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col">
    			<h3>Prediction information</h3>
    			
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
