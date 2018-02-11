define([], function(){
	
	//to round to n decimal places
	var _round = function(num, places) {
		var multiplier = Math.pow(10, places);
		return Math.round(num * multiplier) / multiplier;
	}

    return {
     	round: _round
    }
});

