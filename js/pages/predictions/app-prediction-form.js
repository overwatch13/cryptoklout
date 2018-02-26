define(["cryptcompareGetCoinPrice", "numberUtilities", "jqueryValidate"], function (cryptcompareGetCoinPrice, numberUtilities) {
    //console.log("app-predictions-single-day")
    //cryptcompareGetallcoins.getAllCoins(); // When you want to go multi coin, you already set this up.

    var currentPrice = $("#currentPrice").val().replace(/,/g, '');
    $predictionPrice = $("#predictionPrice");
    $percentageInput = $("#percentageInput");
    $predictionReason = $("#predictionReason");
    $predictionSubmitBtn = $("#predictionSubmitBtn")

    // reuns api to get currentp price.
    /*var btcPrice = cryptcompareGetCoinPrice.getCoinPrice({coinSymbol: "BTC", currency: "USD"}).done(function(data){
    	//console.log(data);
    	currentPrice = data.USD;
    	cryptcompareGetCoinPrice.paintCoinPrice($("#coinPrice"), data, "USD");
    });*/

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

    var _createPredictionObj = function(){
        return {
            operation : "submitPrediction", // for the ajax switch
            function : "submitPrediction", // function name in the class we want to hit.
            predictionDays: $("#predDays").val(), // amount of days the prediction is out for.
            predictionName: $("#predName").val(),
            userId: $("#userId").val(),
            coinSymbol: "BTC",
            currencySymbol: "USD",
            currentPrice: currentPrice,
            predictedPrice: $predictionPrice.val().replace(/,/g, ''),
            percentageDifference: $percentageInput.val(),
            reason: $predictionReason.val(),
        }
    }


    var _submitPrediction = function(){
        // Add validation prior to actually submitting!!! use jquery validate.

        // make call to insert the information for user 1.
        var obj = _createPredictionObj();
        //console.log(obj)
        /*$.blockUI({
            css: {
                backgroundColor: '#7E7E7E',
                color: '#fff'
            },
            message: '<h1>Submitting</h1>'
        });*/

        // do research on security risk of this.
        $.post("/ajax-internal.php", obj).done(function(data) {
            data = $.parseJSON(data);
            console.log(data)
            window.location.href = window.location.origin + "/pages/predictions/prediction-choices.php";
            $(".error").html(data)
        }).fail(function(data) {
            $(".error").html(data)
        }).always(function() {
            $.unblockUI();
        });
    };


    // ******* Click Events *************

    $predictionPrice.on("change", function(){
    	var newNumber = $(this).val().replace(/,/g, '');
    	_changeColor(newNumber);
    	var percentChange = _getPercentageChange(currentPrice, newNumber);
    	var percentChangeRoundedHundreths = numberUtilities.round(percentChange, 2);
    	$percentageInput.val(percentChangeRoundedHundreths);
    	$predictionReason.focus();

    });

    $percentageInput.on("change", function(){
        // do reverse logic of the above in here, so you can derive the predicted price by the percentage given.
        var pDiff = $(this).val();
        var num;
        if(pDiff>0){
            num = currentPrice*(1+(pDiff/100));
            num = numberUtilities.round(num, 2);
            $predictionPrice.val(num);
        }else{
            num = currentPrice*(1+(pDiff/100));
            num = numberUtilities.round(num, 2);
            $predictionPrice.val(num);
        }

        _changeColor(num);
        $predictionReason.focus();
    });


    $predictionSubmitBtn.on("click", function(e){
        e.preventDefault();
        var $submitPredictionForm = $("#submitPredictionForm");
        $submitPredictionForm.validate({
            rules: {
                predictionPrice: { required: true}
            },
            messages: {
                predictionPrice: { required: "A prediction price is required."}
            }
        });

        if ($submitPredictionForm.valid()){
            _submitPrediction();
        }else{
            console.log("form is invalid")
        }


    });


}); // END require
