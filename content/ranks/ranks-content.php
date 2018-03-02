<?php

include ROOT . "_logic/ranks/ranks-content-logic-main.php";
$RanksViewLogic = new RanksViewLogic();
$masterArr =  $RanksViewLogic->main(); // brings back all initial data and views we want to produce in php.
$users = $masterArr['masterArr']['users'];//['users'];
?>

<script>
var ranksMasterArr = <?php echo json_encode($masterArr); ?>
</script>

<section>
	<div class="container">
		<div class="row">
			<div class="col">
				<h3>Rankings of all predictors</h3>
				<?php
				include ROOT . "content/ranks/ranks-content-loop.php";

				// echo "<pre style='font-size:11px;'>";
				// print_r($masterArr);
				// echo "</pre>";

				?>
			</div>
		</div>
	</div>
</section>
