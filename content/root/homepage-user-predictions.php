<<<<<<< HEAD
<style>
    .predictor-img-rounded{
        width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    margin:0 auto;
    cursor:pointer;
    }
    
    .cursor-pointer{
        cursor:pointer;
    }
    
    .pred-img-cont{
        background: #e9e9e9;
    }
    
    .pred-hide-small{
        font-size:12px;
    }
</style>

<?php include ROOT . '/content/phpviews/homepage-content-daily-predictions.php'; ?>

<section class="bg-gray">
    <div class="container">
      <div class="row">
          <div class="col">
              <h4>Recent 24 hour BTC Predictions</h4>
              <div id="recentPredictionsHtml" class="col-xs-12"><?php if(isset($pHtml)){ echo $pHtml; }?></div>
              <pre>
                  <?php /*if(isset($rp)){ print_r($rp); }*/?>
              </pre>
          </div>
      </div>
    </div>
</section>
=======
<section id="about-us" class="about-us bg-gray">
    <div class="container">
      <h2>Recent Predictions</h2>
      <div class="row">
        <div id="recentPredictionsHtml" class="col-xs-12"></div>
      </div>
    </div>
  </section>
>>>>>>> a5a05c54dd4c8cbb32d0db6ab3bdb293029ebbb0
