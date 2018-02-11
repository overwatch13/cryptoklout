
<?php /*include "homepage-content-logic.php"; */ ?>

<section id="hero" class="bg-gray">
    <div class="container">
      <div class="row d-flex">
        <div class="col-lg-6 text order-2 order-lg-1">
          <h3>Single Day Prediction</h1>
          <p>Price of Bitcoin right now is...  <span id="coinPrice" style="font-weight:bold;"></span></p>
          <p>Do you think the price of BTC will be higher or lower in 24 hours?</p>
          <form style="margin-top:20px;" class="clear">
            <div class="clear">
                <div class="form-group small-width pull-left">
                  <label for="predictionPrice">Predicted price *</label>
                  <input type="text" id="predictionPrice" class="form-control">
                </div>
                <div class="form-group small-width pull-left" style="max-width:200px;">
                  <label for="percentageInput">Percentage difference</label>
                  <input type="text" id="percentageInput" class="form-control" style="max-width:90px;">
                </div>
            </div>

            <div class="form-group">
              <label for="predictionReason">Want to leave a reason? urls and references are allowed.</label>
              <textarea class="form-control" id="predictionReason" rows="5"></textarea>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
   