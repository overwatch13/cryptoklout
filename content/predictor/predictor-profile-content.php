
<?php 
include ROOT . "content/phpviews/profile-page-logic.php"; ?>
<script>
var userPredictions = <?php echo json_encode($masterArr); ?>
</script>


<?php 
// echo "<pre style='font-size:11px;'>";
// print_r($masterArr); 
// print_r($_SESSION);
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
        <div class="col" style="margin-bottom:20px;">
            <a href="/pages/predictions/prediction-choices.php" class="btn btn-primary navbar-btn btn-shadow btn-gradient pull-right">New Prediction</a>
        </div>
    </div>
    <div class="row">
      <div class="col user-profile-container">
          <div class="profile-img-cont">
            <div class="profile-img-rounded cursor-pointer " data-userid="2">
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
                    <div class="card-text"><?php echo sizeof($masterArr['predictionsTogether']); ?></div>
                </div>
            </div>
            <div class="card user-profile-card pull-left">
                <div class="card-body">
                    <div class="card-title">Correct</div>
                    <div class="card-text"></div>
                </div>
            </div>
            
          </div>
        
      </div>
    </div><!-- row -->

    <!-- <div class="row" style="margin-top:40px;">
        <div class="col">
            <h3>Predictions</h3>
            <div id="js-predictions-view"></div>
      </div>
    </div>-->

    <div class="row" style="margin-top:40px;">
        <div class="col">
            <!-- emmet script div.date-line.clear>(div.date-box-container>(div.color-coded.bg-success+div.date-container>div.rotate{2-14-18}))*30 -->
        <h5>All Predictions (BTC)</h5>
        <div class="date-line clear">
            <?php echo $predictionListHtml; ?>
        </div><!-- .date-line -->
        </div><!-- col -->
    </div><!-- .row date block -->


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



