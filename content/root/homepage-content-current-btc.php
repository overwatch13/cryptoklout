<?php
include ROOT . "_classes/pricetrackingbtc.class.php";
$PriceTrackingBtc = new PriceTrackingBtc();
$price = $PriceTrackingBtc->getLatestBtc();
$displayHomepageCurrentPrice = false;

if($price['query'] && sizeof($price['query'])>0 && $price['query'][0]['PRICE'] !==""){
	$price = number_format($price['query'][0]['PRICE']);
	$displayHomepageCurrentPrice = true;
}

?>

<? if($displayHomepageCurrentPrice){ ?>
<section>
  <div class="container text-center">
    <h3>Current Price of Bitcoin is... <span class="text-color-main">$<?php echo $price; ?></span></h3>
    <p>Will the price of BTC be higher or lower tomorrow?</p>
		<?php if(isset($_SESSION['email'])): ?>
			<a href="/pages/predictions/prediction-choices.php" class="btn btn-primary navbar-btn btn-shadow btn-gradient" style="margin-top:10px;">Start</a>
		<?php else: ?>
			<a href="#" data-toggle="modal" data-target="#modal-signin" class="btn btn-primary navbar-btn btn-shadow btn-gradient" style="margin-top:10px;">Start</a>
		<?php endif; ?>
  </div>
</section>
<? } ?>
