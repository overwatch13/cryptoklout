
<?php
include ROOT . "content/phpviews/profile-page-logic.php"; ?>
<script>
var userPredictions = <?php echo json_encode($masterArr); ?>
</script>


<?php
// echo "<pre style='font-size:11px;'>";
// print_r($masterArr);
// echo "</pre>";
?>

<?php if(!$masterArr['predictorFound']): ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>We could not locate that predictor, please try a different url.</p>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section id="hero" class="section-small bg-gray">
    <div class="container">
    <div class="row">
      <div class="col user-profile-container">
          <div class="profile-img-cont">
            <div class="profile-img-rounded">
                <img src="/img/avatar-5.jpg" width="100">
            </div>
          </div>

          <div class="card-container">
              <div class="card user-profile-card pull-left">
                <div class="card-body">
                    <div class="card-title">CryptoKlout Score</div>
                    <div class="card-text text-success"></div>
                </div>
            </div>
            <div class="card user-profile-card pull-left">
                <div class="card-body">
                    <div class="card-title">Better than</div>
                    <div class="card-text"></div>
                </div>
            </div>
              <div class="card user-profile-card pull-left">
                <div class="card-body">
                    <div class="card-title">Total Predictions</div>
                    <div class="card-text"><?php echo sizeof($masterArr['predictionsRawData']); ?></div>
                </div>
            </div>
            <div class="card user-profile-card pull-left">
                <div class="card-body">
                    <div class="card-title">Correct</div>
                    <div class="card-text"><?php echo $masterArr['correctPercent']; ?>%</div>
                </div>
            </div>

          </div>

      </div>
    </div><!-- row -->

    <div class="row" style="margin-top:40px;">
        <div class="col">
          <h5>Future Predictions of Bitcoin</h5>
          <div class="date-line clear">
              <?php echo $masterArr['futurePredictions']; ?>
          </div><!-- .date-line -->
        </div><!-- col -->
    </div><!-- .row date block -->

    <div class="row" style="margin-top:40px;">
        <div class="col">
          <h5>Results</h5>
          <div class="date-line clear">
              <?php echo $masterArr['pastPredictions']; ?>
          </div><!-- .date-line -->
        </div><!-- col -->
    </div><!-- .row date block -->

    <div class="row" style="margin-top:40px;">
        <div class="col">
            <div class="accordianWrapper">
                <span class="accordianTitle"><a href="#">Understanding a prediction block</a></span>
                <div class="accordianContent">
                  3d: the prediction will last for 3 days.
                  <div class="">
                    <i class="fas fa-long-arrow-alt-right up"></i>,<i class="fas fa-long-arrow-alt-right down"></i>: whether the person is predicting the price will go up or down in the timeframe.
                  </div>
                  W: what the price <span class="bold">was</span> at the time of the prediction. <br/>
                  T: what the <span class="bold">target</span> price of the prediction is. (what they think it will be)<br/>
                  P: what the <span class="bold">percentage</span> difference is between what the price was and what the person predicted will be.<br/>
                  <!-- M: when the prediction was <span class="bold">made</span>. <br/>
                  E: when the prediction <span class="bold">expires</span>, this is when we check to see whether it was successful for not.<br/> -->
                  Success, Missed: After the prediction expires we check to see whether the prediction was successful or not.
                </div>
            </div>
      </div>
    </div>

    <div class="row" style="margin-top:40px;">
        <div class="col">
            <h5>About Sandra</h5>
            <div class="user-profile-personal">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Twitter: </li>
                    <li class="list-group-item">Facebook: </li>
                    <li class="list-group-item">Website: </li>
                  </ul>
            </div>
          </div><!-- col -->
    </div><!-- .row date block -->
<?php endif; ?>
