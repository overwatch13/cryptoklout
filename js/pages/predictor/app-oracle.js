define([], function () {
    console.log(userPredictions); // this data is coming from PHP for quicker response and load time.

    // Currently not using this as a means of display. 
    // First attempt at displaying the information through JS. not very happy with this so far.
    var _paintPredictions = function(){
        var html= $("</div>");
        for(var key in userPredictions){
            var keyHolder = "";
            if(key == "pred1"){
                html.append($("<h5>Single Day Predictions</h5>"));
                keyHolder = key;
            }else if(key == "pred3"){
                html.append($("<h5>3 Day Predictions</h5>"));
                keyHolder = key;
            }else if(key == "pred7"){
                html.append($("<h5>1 Week Predictions</h5>"));
                keyHolder = key;
            }else if(key == "pred14"){
                html.append($("<h5>2 Week Predictions</h5>"));
                keyHolder = key;
            }else if(key == "pred30"){
                html.append($("<h5>1 Month Predictions</h5>"));
                keyHolder = key;
            }else if(key == "pred90"){
                html.append($("<h5>3 Month Predictions</h5>"));
                keyHolder = key;
            }else{
                keyHolder = "";
            }

            // Now put in the meat of each prediction
            if(userPredictions.hasOwnProperty(keyHolder)){
                var predictionTypeArr = userPredictions[keyHolder]; // sets the array for a type like "pred1": [{pred}, {pred}]
                var htmlT = $("<div class='date-line clear'></div>");
                for(var i=0; i<predictionTypeArr.length; i++){
                    var dateBox = $("<div class='date-box-container'></div>");
                    htmlT.append(dateBox);
                }
                html.append(htmlT); // adds the section to the main html block.
            }
        }

        $("#js-predictions-view").append(html);
    };


    /*if(userPredictions){
     _paintPredictions();
    }*/


}); // END require
