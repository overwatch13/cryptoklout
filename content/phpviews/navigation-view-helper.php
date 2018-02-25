<?php 
$navigationConfirmationMessageOn = false;
$navigationMessage = "";
if(isset($_GET['success'])){
	if($_GET['success']=="activation"){
		$navigationConfirmationMessageOn = true;
		$navigationMessage = '<li class="nav-item text-warning" style="padding-right:30px;">Please confirm your email address</li>';
	}
}


