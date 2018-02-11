define(["cryptcompareGetCoinPrice", "numberUtilities"], function (cryptcompareGetCoinPrice, numberUtilities) {
    console.log("app-predictions-single-day")
    //cryptcompareGetallcoins.getAllCoins(); // When you want to go multi coin, you already set this up. 

    var currentPrice;
    $predictionPrice = $("#predictionPrice");
    $percentageInput = $("#percentageInput");
    $predictionReason = $("#predictionReason");

    var btcPrice = cryptcompareGetCoinPrice.getCoinPrice({coinSymbol: "BTC", currency: "USD"}).done(function(data){
    	//console.log(data);
    	currentPrice = data.USD;
    	cryptcompareGetCoinPrice.paintCoinPrice($("#coinPrice"), data, "USD");
    });

    //console.log(btcPrice)
    /**/


   var _getPercentageChange = function(oldNumber, newNumber){
		// works for decreasing numbers, 9, 6 == 66% decrease.
		$percentChange = ((oldNumber - newNumber) / oldNumber) * 100;
		// Note, if answer is negative, it is a postive increase.
		// if answer is positive it is a % decrease. 
		$percentChange = $percentChange * -1;
		return $percentChange;
	}

    var _changeColor = function(pp){
    	console.log(currentPrice);

    	// sets color of the percentage difference input
    	if(pp>=currentPrice){
    		$percentageInput.addClass("green-text");
    		$percentageInput.removeClass("red-text");
    	}else{
    		$percentageInput.addClass("red-text");
    		$percentageInput.removeClass("green-text");
    	}
    };
    
    $predictionPrice.on("change", function(){
    	var newNumber = $(this).val();
    	_changeColor(newNumber);
    	var percentChange = _getPercentageChange(currentPrice, newNumber);
    	var percentChangeRoundedHundreths = numberUtilities.round(percentChange, 2);
    	$percentageInput.val(percentChangeRoundedHundreths);
    	$predictionReason.focus();

    });


}); // END require
