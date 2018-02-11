define([], function(){

	var _getCoinPrice = function(coinParams){
		// right now you are only getting one coin and one currency
		var url = "https://min-api.cryptocompare.com/data/price?fsym="+coinParams.coinSymbol+"&tsyms="+coinParams.currency+"";
		return $.getJSON(url, function( data ) {
			//console.log(data)
		});
	};

	var _paintCoinPrice = function($element, data, currency){
		$element.text(data[currency]);
	};

     return {
     	getCoinPrice: _getCoinPrice,
     	paintCoinPrice : _paintCoinPrice,
     }
});