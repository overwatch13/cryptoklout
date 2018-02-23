<?php
include $_SERVER['DOCUMENT_ROOT']. "/config.php";
include ROOT . "_classes/custom.class.php";

$facebookata = new Custom();
echo $returnData = $facebookata->facebookLogin($_POST["email"]);
?>
