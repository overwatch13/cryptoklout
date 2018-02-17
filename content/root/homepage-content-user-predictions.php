<?php include ROOT . 'content/phpviews/homepage-content-daily-predictions.php'; ?>

<section class="bg-gray">
    <div class="container">
      <div class="row">
          <div class="col">
              <h4>Recent 24 hour BTC Predictions</h4>
              <div class="col-xs-12"><?php if(isset($pHtml)){ echo $pHtml; }?></div>
              <div class="col-xs-12"><?php if(isset($pWideHtml)){ echo $pWideHtml; }?></div>
              <pre>
                  <?php /*if(isset($rp)){ print_r($rp);} */ ?>
              </pre>
          </div>
      </div>
    </div>
</section>

