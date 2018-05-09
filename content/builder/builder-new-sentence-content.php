<?php /*include ROOT . "content/prediction/content-proof-php-logic.php";*/ ?>
<script>
    //var payload = <?php /*echo json_encode($payload); */?>;
</script>


<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Trigger Builder</h3>
                <div>Rule 1</div>
                <div id="app"></div>
                
                <div style="margin-top:15px; display:inline-block;">How many times would you like the rule to apply?</div>
                
                <div class="inline-input">
                	<div class="form-group" style="min-width:60px;">
					    <select class="form-control" id="exampleFormControlSelect1">
					      <option selected="true">1</option>
					      <option>2</option>
					      <option>3</option>
					      <option>4</option>
					      <option>5</option>
					    </select>
				  </div>
                </div>
                <div class="helper-icon-container">
                	<img src="/img/question-mark-icon-2.png" data-toggle="tooltip" title="For example: When BTC increases 5% (THREE TIMES) within 10 days" />
                </div>
            	
               <div>Total time all rules are bound within</div>
				<div class="inline-input">
                	<div class="form-group">
                		<input id="totalTimeNumber" type="number" value="1" class="input-styling" style="width:70px;">
                	</div>
                </div>
                <div class="inline-input">
                	<div class="form-group" style="min-width:60px;">
						<select class="form-control" id="totalTimeType">
						<option selected="true">week</option>
						<option>day</option>
						<option >hour</option>
						</select>
				  </div>
                </div>

                <h4 class="title-space">Final Trigger in Text format</h4>
                <div id="final-output"></div>

				<h4 class="title-space">Prediction</h4>
				<p>Similar sentence builder to the entire top, except this is latched on, and starts to fire off when the trigger is activated. We can than track if anyone is making correct predictions, while they get benefit from getting messages on the triggers. </p>


				


				<h4 class="title-space">On Successful Trigger</h4>
				<div style="margin-left:30px;">
					<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
				  <label class="form-check-label" for="defaultCheck1">
				    Text message
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
				  <label class="form-check-label" for="defaultCheck2">
				    Email
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" disabled>
				  <label class="form-check-label" for="defaultCheck3">
				    Instabot (Add this info under my profile)
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
				  <label class="form-check-label" for="defaultCheck4">
				    Turn the trigger off after its first successful hit
				  </label>
				</div>
				</div>
				
				

                <div class="clear" style="margin-top:40px;">
					<button id="reset-builder" type="button" class="btn btn-warning pull-right">Reset</button>
                	<button type="button" class="btn btn-primary pull-right" style="margin-right:15px;">Save</button>
                </div>
                
                <h4 class="title-space">Options Reference</h4>
                <div class="clear">
	                <div class="option-container">
	                	<div class="option-title">Direction</div>
	                	<div class="option">decreases</div>
	                	<div class="option">increases</div>
	                	<div class="option">reaches</div>
	                </div>

	                <div class="option-container">
	                	<div class="option-title">Indicators</div>
	                	<div class="option">price</div>
	                	<div class="option">volume</div>
	                	<div class="option">low (a low within a specified amount of time)</div>
	                	<div class="option">high (a high within a specified amount of time)</div>
	                </div>

	                <div class="option-container">
	                	<div class="option-title">Connectors</div>
	                	<div class="option">then</div>
	                	<div class="option">and</div>
	                	<div class="option">times (three times)</div>
	                	<div class="option">within</div>
	                </div>

	                <div class="option-container">
	                	<div class="option-title">Time frame</div>
	                	<div class="option">minutes</div>
	                	<div class="option">hours</div>
	                	<div class="option">days</div>
	                </div>
                </div>
                
				<h4 class="title-space">Target Examples</h4>
                	<p>When BTC price increases by 5% within 5 hours</p>
                	<p>When BTC price increases by 5% in 1 day, 3 times, within a 14 day period</p>
                	<p>When BTC price increases by 5% then drops 6% within a 3 day period then increases by 5% within 1 day period</p>
                	<p>When BTC reaches a new 15 day low, then does not reach a new low for 10 days </p>

                <div style="margin-top:50px;">
                	<p>Experimental</p>
                	<select class='js-coin-select' name='coinsSelect' ></select>

                </div>
                
            </div>
        </div>
    </div>
</section>
