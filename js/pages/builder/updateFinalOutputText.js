define([], function () {
	// Update the final output every time they keyup.
	var _updateFinalOutput = function(){
		$("#final-output").html('');
		var mainString = "";
		$.each($(".appWrapper .cell"), function(){
			mainString += " " + $(this).val();
		});
		//console.log(mainString)

		// TO DO
		// Multiply by the iterations, do this later after you get that additional functionality working.

		// Add in the total bound time

		var timeString = _transmuteTime($("#totalTimeNumber").val(), $("#totalTimeType").val());
		mainString += timeString;

		// Final attachment
		$("#final-output").html($.trim(mainString));
	};

	var _transmuteTime = function(amount, timeType){
		//console.log(amount, timeType)
		var string="";
		if(amount==1){
			string = " within " + amount + " " + timeType; // essentially doing nothing, already singular.
		}else if(amount>1){
			string = " within " + amount + " " + timeType + "s";
		}
		return string;
	};

	return{
		updateFinalOutput : _updateFinalOutput
	}
})