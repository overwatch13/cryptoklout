// You attempted this on homepage, via the javascript model, but it was too slow so you are now trying a php verison instead. 
define([], function () {
    
    // you would need to make a call to go all the way to the backend. You didnt extend the DB to the real one SOB!!!!
    // Perhaps you can work on the multi call function at least? and retrieve simple information? 
    
    var _painRecentUsers = function(data){
        //console.log(data)
        var html = "<h4>24 Hour Predictions of BTC</h4>";
        html += `<table class="table"> 
            	<thead> 
            		<th>Predictor</th> 
            		<th>Coin / currency</th> 
            		<th>Predicted Price</th> 
            		<th>% diff</th> 
            		<th>Reason</th> 
            		<th>Predictor Accuracy</th> 
            	</thead><tbody>`;
        // manage the array and paint to the ui. 
        // the CSS will need to be moved to the less file. 
        for(var i=0; i<data.length; i++){
            var t = `<tr>
    			<td><div class="predictor-img-rounded cursor-pointer" data-userid="`+data[i].userId+`"><img src="/img/avatar-5.jpg" width="60"/></div></td>
    			<td>`+data[i].coinSymbol+` / `+data[i].currencySymbol+`</td>
                <td>`+data[i].predictedPrice+`</td>
                <td>`+data[i].percentageDifference+`</td>
                <td>`+data[i].reason+`</td>
                <td></td>
    		</tr>`;
    		html+=t;
        }
        
        html +="</tbody></table>";
        
        $("#recentPredictionsHtml").html(html);
    };
    
    var _getRecentUsers = function(){
        var obj = {
            operation : "getPredictions", // for the ajax switch
            function : "getPredictions", // function name in the class we want to hit.
        }
        
        $.post("/ajax-internal.php", obj).done(function(data) {
            data = $.parseJSON(data);
            if(data !==null){
                _painRecentUsers(data.query);
            }
            
           // $(".error").html(data)
        }).always(function() {
            $.unblockUI();
        });
    };
    
    // ***** prediction Consensus Stuff *****
    $("#predictionConsensusHtml"); // the hook
    
    var _getPredictionConsensus = function(){
        var obj = {
            operation : "getPredictionConsensus", // for the ajax switch
            function : "getPredictionConsensus", // function name in the class we want to hit.
        }
        
        $.post("/ajax-internal.php", obj).done(function(data) {
            data = $.parseJSON(data);
            console.log(data)
            /*if(data !==null){
                _painRecentUsers(data.query);
            }*/
            
           // $(".error").html(data)
        })
    };
    
    // ****** Initial page calls, and click events down here **********
    
    _getRecentUsers();
    
    //_getPredictionConsensus();

}); // END require
