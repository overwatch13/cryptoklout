define(["cryptcompareGetallcoins", "triggerUtilities", "triggerOptionsData"], function (cryptcompareGetallcoins,  triggerUtilities, triggerOptionsData) {
    // *** Return functions ***
    var getContainer = function(){
        return $("<div class='appWrapper'></div>");
    };

    var _createInputCell = function(text, type){
        var input;
        switch(type){
            case "initial": // do nothing
                input = $("<input class='standardInput cell' value='"+text+"' data-type='"+type+"'></input>");
                break;
            case "coin-type":
                input = $("<input class='standardInput cell' value='"+text+"' data-type='"+type+"' data-toggle='tooltip' title='Coin type such as Bitcoin or BTC'></input>");
                break;
        }
       
        if(text !==""){
            triggerUtilities.resizeInput(input);
        }
        return input;
    };

    var _decideAvailableOptions = function(){
        // unusued
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
        createInputCell:_createInputCell,
        decideAvailableOptions: _decideAvailableOptions,
    }

}); // END require
