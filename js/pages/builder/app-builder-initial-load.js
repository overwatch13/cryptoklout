
define(["builderFragments", "triggerUtilities"], function (builderFragments, triggerUtilities) {
// file is responsible for the main load of the entire page. outsource everything from here.
	
	// sets new focus on tab out, taking into consideration multiple cases. 
	var _setNewFocus = function(){
		focusedElement = $(".appWrapper .cell:last");
		focusedElement.focus();
		focusedElement.on('keydown', function(e) { 
			var keyCode = e.keyCode || e.which; 
			if(e.shiftKey){
				//return false;
			}
			else if (keyCode == 9) { 
				e.preventDefault(); 
				console.log("tab hit");
				// If they tab, and there is another cell next to it, than we do not create another cell.
				if($(this).val()==""){
					// the user did not input anything so do not create a new input
				}
				else if(($(this).index()+1) < $(".appWrapper .cell").length){ // somehow determine if this is the last cell or not. 
					// This is the case to determine if it is the last cell or not.
					// index starts at 0, so index() of 1 means there are 2 elements.
					// Focus on the next input 
					$(".appWrapper .cell").eq($(this).index()+1).focus();
				}else{
					// it is the last cell so make another one.
					let inputCell = builderFragments.createInputCell("");
					$(".appWrapper").append(inputCell);
					_setNewFocus();
				}

				// Resize the input once you are done with it.
				triggerUtilities.resizeInput($(this));

				_updateFinalOutput();
			} 
		});
	};

	

	// Update the final output every time they keyup.
	var _updateFinalOutput = function(){
		$("#final-output").html('');
		var mainString = "";
			$.each($(".appWrapper .cell"), function(){
				mainString += " " + $(this).val();
			});
			console.log(mainString)
			$("#final-output").html(mainString);
	};

	// First function that runs to start the app off. Should be resusable.
	var startApp = function(){
		var app = $("#app");
		app.html(''); // reset in case there was content. 
		var focusedElement;

		let appContainer = builderFragments.getContainer();
		let firstCell = builderFragments.createInputCell("When");
		appContainer.append(firstCell); // would always start with a When

		let inputCell = builderFragments.createInputCell("");
		appContainer.append(inputCell);
		app.append(appContainer);

		_setNewFocus(); // fires initially. 
	}; // end startApp();

	// ***** Main Click Events ******
	$("#reset-builder").on("click",function(){
		startApp();
	});

	startApp();

}); // END require


//******** Unused ************
// This focus out approach does not work, because we only want to create a new tab when they hit tab. 
// focusedElement.focusout(function(){
// 	// create a new element since the user focussed out. 
// 	let inputCell = builderFragments.createInputCell();
// 	appContainer.append(inputCell);
// 	setNewFocus();
// });