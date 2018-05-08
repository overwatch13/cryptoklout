define(["cryptcompareGetallcoins", "triggerUtilities"], function (cryptcompareGetallcoins,  triggerUtilities) {
    // *** Return functions ***
    var getContainer = function(){
        return $("<div class='appWrapper'></div>");
    };

    var _createInputCell = function(text){
        var input = $("<input class='standardInput cell' value='"+text+"'></input>");
        if(text !==""){
            triggerUtilities.resizeInput(input);
        }
        return input;
    };


    //*****************

    // actually goes and creates the coin select, just an example but probably deeper than we want to go. 
    var createCoinSelect = function(){
    var coinSelect = $("<select class='js-coin-select' name='coinsSelect'></select>");
        cryptcompareGetallcoins.getAllCoins(coinSelect)
    }; 
    createCoinSelect();

    return {
        getContainer: getContainer,
        createInputCell:_createInputCell
    }

}); // END require
