<?php 
// Purpose: this file runs every minute via crontab. The script fires the getJson function to make the call out to cryptocompare. Once retrieved it ajax's the data out to our server for permanent keeping. 
//echo getcwd() . "\n";

if(empty($_SERVER['DOCUMENT_ROOT'])){ // 
    chdir("/home/cryptoklout/public_html/jobs/");
}

include  "../config.php"; 
include ROOT . "_classes/submitRecurringCoinInfo.class.php"; 

$data = file_get_contents("https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC&tsyms=USD");
$data = json_decode($data, true);
//print_r($data);
$submitCoinInfo = new submitRecurringCoinInfo();
$submitCoinInfo->submitBTC($data['RAW']['BTC']['USD']); // data.RAW.BTC.USD

echo "success";

?>
