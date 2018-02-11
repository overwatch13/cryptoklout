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
		
		console.log(results)
		// Extract the selector out of hte function so it can be re-used, putting it here for demo purposes. 
		// This is working, but you are not ready for multipl coins yet!!!
		// <select class="js-coin-select" name="coinsSelect"></select>
		$(".js-coin-select").select2({data: results});

		/*, function(obj){
			//obj.id = obj.id || obj.Id; // each object must have .id, and .text. but our object has different names. 
			//obj.text = obj.text || obj.FullName;
		}*/
	};
	
	var _getAllCoins = function(){
		console.log("all coins")
		$.getJSON( "https://min-api.cryptocompare.com/data/all/coinlist", function( data ) {
			_createCoinSelectionDropdown(data);
			//console.log(data)
		}).done(function() {
		    //console.log( "second success" );
		  })
		  .fail(function() {
		    //console.log( "error" );
		  })
		  .always(function() {
		   //console.log( "complete" );
		  });

	};


     return {
     	getAllCoins: _getAllCoins
     }
});