define([], function(){
	
	//to round to n decimal places
	var _round = function(num, places) {
		var multiplier = Math.pow(10, places);
		return Math.round(num * multiplier) / multiplier;
	}

	var _numberWithCommas = (x) => {
	  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

    return {
     	round: _round,
     	numberWithCommas:_numberWithCommas
    }
});

