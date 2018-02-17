
// YOU ARE NOT USING THIS ANYMORE, GOING DIRECTLY THROUGH PHP 
$(function(){

    var _postDataToDb = function(info){
        //console.log(info);
        var obj = {
            operation: "submitBTCData",
            payload: info
        }
        $.post("/ajax-internal.php", obj).done(function(data) {
            data = $.parseJSON(data);
            //console.log(data)
        })
    };
    
    // retrive the btc full information and get the 
    var url = "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC&tsyms=USD";
		return $.getJSON(url, function( data ) {
			
			// ok we could than api call this out since it is once a minute?
			if(data && data !==null){
			    _postDataToDb(data.RAW.BTC.USD)
			}else{
			    // send out an email to ourselves so we know this is failing. // needs to be done through ajax call. 
			}
			
		});
})
