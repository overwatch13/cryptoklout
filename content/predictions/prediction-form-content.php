<!-- get btc price via db instead of JS, lower the api load -->
<?php 
//echo ROOT;
include ROOT . "../../_classes/pricetrackingbtc.class.php";

$PriceTrackingBtc = new PriceTrackingBtc();
$price = $PriceTrackingBtc->getLatestBtc();

if($price['query'] && sizeof($price['query'])>0 && $price['query'][0]['PRICE'] !==""){
  $price = number_format($price['query'][0]['PRICE']);
}

?>


<input type="hidden" id="predDays" value="<?php echo $predDaysFuture; ?>">
<input type="hidden" id="predName" value="<?php echo $predName; ?>">

<section id="hero" class="bg-gray">
    <div class="container">
      <div class="row d-flex">
        <div class="col-lg-6 text order-2 order-lg-1">
          <div class="error"></div>
          <h3><?php echo $predH1; ?></h1>
          <p>Price of Bitcoin right now is...  <span class="text-color-main-dark" style="font-weight:bold;">$<?php echo $price; ?></p>
          <p>Do you think the price of BTC will be higher or lower in <?php echo $predDaysFuture; ?> day<?php if($predDaysFuture>1){echo "s";}; ?>?</p>
          <form id="submitPredictionForm" style="margin-top:20px;" class="clear">
            <div class="clear">
                <div class="form-group small-width pull-left">
                  <label for="predictionPrice">Predicted price *</label>
                  <input type="text" id="predictionPrice" class="form-control" name="predictionPrice">
                </div>
                <div class="form-group small-width pull-left" style="max-width:200px;">
                  <label for="percentageInput">Percentage difference</label>
                  <input type="text" id="percentageInput" class="form-control" style="max-width:90px;">
                </div>
            </div>

            <div class="form-group">
              <label for="predictionReason">Want to leave a reason?</label>
              <textarea class="form-control" id="predictionReason" rows="5"></textarea>
            </div>
            <button id="predictionSubmitBtn" class="btn btn-primary" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
   