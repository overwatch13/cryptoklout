<div class="rank-header-container">
  <div class="cell">Rank</div>
  <div class="cell">CryptoScore</div>
  <div class="cell">Predictor</div>
</div>

<!-- we could really use their first and last name here, which we would need to get from the initial form. -->

<?php foreach($users as $key=>$user){ ?>
  <div class="ranks-container cursor-pointer" data-id="<?php echo $user['userId']; ?>">
    <div class="cell">
      <div class="rank-title cell"><?php echo $key+1; ?></div>
    </div>
    <div class="cell">
      <div class="crypto-score-title cell"><?php echo $user['cryptoScore']; ?></div>
    </div>

    <!-- if the image exists, print it. -->
    <?php if($user['picture']!==""){ ?>
      <div class="cell">
        <div class="picture-container">
          <img src="<?php echo $user['picture']; ?>"/>
        </div>
      </div>
    <?php } ?>

    <div class="cell">
      <div class="profile-info">
        <?php echo $user['first_name']." ". $user['last_name']; ?>
      </div>
    </div>
  </div>
<?php } ?>
