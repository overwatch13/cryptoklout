define(["numberUtilities"], function(numberUtilities){

	var _getCoinPrice = function(coinParams){
		// right now you are only getting one coin and one currency
		var url = "https://min-api.cryptocompare.com/data/price?fsym="+coinParams.coinSymbol+"&tsyms="+coinParams.currency+"";
		return $.getJSON(url, function( data ) {
			//console.log(data)
		});
	};

	var _paintCoinPrice = function($element, data, currency){
		var rounded = numberUtilities.round(data[currency], 0);
		var numWithCommas = numberUtilities.numberWithCommas(rounded);
		$element.text(numWithCommas);
	};

     return {
     	getCoinPrice: _getCoinPrice,
     	paintCoinPrice : _paintCoinPrice,
     }
});