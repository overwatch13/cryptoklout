define([], function(){

	var _createCoinSelectionDropdown = function(allCoins){
		var allCoins = allCoins;
		var coinDataObj = allCoins.Data;
		var results = [];
		for(var a in coinDataObj){
			var temp = {
				id : coinDataObj[a].Id,
				text: coinDataObj[a].FullName
			};
			results.push(temp);
		}

		//console.log(results)
		// Extract the selector out of hte function so it can be re-used, putting it here for demo purposes.
		// This is working, but you are not ready for multipl coins yet!!!
		//<select class="js-coin-select" name="coinsSelect"></select>
		$(".js-coin-select").select2({data: results});

		// Somehow need to attach this to the dom, or return interval
		//console.log($selector);
		/*, function(obj){
			//obj.id = obj.id || obj.Id; // each object must have .id, and .text. but our object has different names.
			//obj.text = obj.text || obj.FullName;
		}*/
	};

	var _getAllCoins = function($selector){
		//console.log("all coins")
		var coinSelector = $.getJSON( "https://min-api.cryptocompare.com/data/all/coinlist", function(data) {
			//console.log("inside of _getAllCoins")
			//console.log(data)
			var coinSelector = _createCoinSelectionDropdown(data);
		}).done(function() {})
	};


   return {
   		getAllCoins: _getAllCoins
   }
});
