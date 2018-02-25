<?php include ROOT . 'content/phpviews/homepage-content-daily-predictions.php'; ?>

<section class="bg-gray">
    <div class="container">
      <div class="row">
          <div class="col">
              <h3>Recent BTC Predictions</h4>
              <div class="col-xs-12"><?php if(isset($pHtml)){ echo $pHtml; }?></div>
              <!-- <pre>
                  <?php /*if(isset($rp)){ print_r($rp);} */ ?>
              </pre> -->
          </div>
      </div>
    </div>
</section>

