
define(["builderFragments", "triggerUtilities", "updateFinalOutputText"], function (builderFragments, triggerUtilities, updateFinalOutputText) {
// file is responsible for the main load of the entire page. outsource everything from here.
	
	// sets new focus on tab out, taking into consideration multiple cases. 
	var _setNewFocus = function(){
		focusedElement = $(".appWrapper .cell:last");
		focusedElement.trigger("click").focus();

		// Need logic that can actually detect the type of input it is, or which input
		// precedes it, for example after WHEN the next one should be BTC, 
		// after a Coin input, the next input needs to be an directions input.
		builderFragments.decideAvailableOptions(); // not sure if this is the best name for it.

		focusedElement.on('keydown', function(e) { 
			var keyCode = e.keyCode || e.which; 
			if(e.shiftKey){
				// the user hit the shift key, so we do nothing, because we do not want to activate on shift+tab, only on tab.
			}
			else if (keyCode == 9) { 
				e.preventDefault(); 
				console.log("tab hit");
				// If they tab, and there is another cell next to it, than we do not create another cell.
				if($(this).val()==""){
					// the user did not input anything so do not create a new input
				}
				else if(($(this).index()+1) < $(".appWrapper .cell").length){ 
					// Attempt to determine if this is the last cell or not, if this passes it is not the last cell.
					// index starts at 0, so index() of 1 means there are 2 elements.
					// Focus on the next input 
					$(".appWrapper .cell").eq($(this).index()+1).focus();
				}else{
					// it is the last cell so make another one.
					let inputCell = builderFragments.createInputCell("");
					$(".appWrapper").append(inputCell);
					
					// Resize the input once you are done with it.
					triggerUtilities.resizeInput($(this));

					_setNewFocus();
				}

			
				updateFinalOutputText.updateFinalOutput();
			} 
		});
	};

	// First function that runs to start the app off. Should be resusable.
	var startApp = function(){
		var app = $("#app");
		app.html(''); // reset in case there was content. 
		var focusedElement;

		let appContainer = builderFragments.getContainer();
		let firstCell = builderFragments.createInputCell("When", "initial");
		appContainer.append(firstCell); // would always start with a When

		let inputCell = builderFragments.createInputCell("", "coin-type");
		appContainer.append(inputCell);
		app.append(appContainer);

		_setNewFocus(); // fires initially. 
		updateFinalOutputText.updateFinalOutput();
	}; // end startApp();

	// ***** Main Click Events ******
	$("#reset-builder").on("click",function(){
		startApp();
	});

	$("#totalTimeNumber, #totalTimeType").on("change paste keyup", function(){
		updateFinalOutputText.updateFinalOutput();
	})

	$("body").on("click", ".cell", function(){
		// shut off all tool tips
		$(".cell").tooltip("hide");
		$(this).tooltip({trigger: 'manual'}).tooltip('show');
	});
	
	//$('[data-toggle="tooltip"]').tooltip(); // sets all of the helper tool tips
	
	// start of the initial application
	startApp();

}); // END require

