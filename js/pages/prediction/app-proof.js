// move this folder under pages/ when at home.

//"techan" // not working as an include right now
//, "react", "reactDOM"
// , React, ReactDOM
// "techan", , techan
define(["d3",  "chartJs", "chartJsPluginAnnotation", "dateUtilities", "numberUtilities"], function (d3, chartjs, chartJsPluginAnnotation, dateUtilities, numberUtilities) {
   //var techan = require('techan'); // failed attempt at techan
   //console.log(d3);
   console.log(payload);


  // https://codepen.io/sanal/pen/RGYzVo allows for 2 lines on same chart example
  var _initializeChart = function(){
    var ctx = $("#myChart")[0].getContext('2d');
     var myChart = new Chart(ctx, {
         type: 'line',
         data: {
             labels: payload.graphX, //["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
             datasets: [{
                 label: 'Price of Bitcoin',
                 data: payload.graphY, //[12, 19, 3, 5, 2, 1000],
                 backgroundColor: [
                     'rgba(255, 99, 132, 0.2)',
                     'rgba(54, 162, 235, 0.2)',
                     'rgba(255, 206, 86, 0.2)',
                     'rgba(75, 192, 192, 0.2)',
                     'rgba(153, 102, 255, 0.2)',
                     'rgba(255, 159, 64, 0.2)'
                 ],
                 borderColor: [
                     'rgba(255,99,132,1)',
                     'rgba(54, 162, 235, 1)',
                     'rgba(255, 206, 86, 1)',
                     'rgba(75, 192, 192, 1)',
                     'rgba(153, 102, 255, 1)',
                     'rgba(255, 159, 64, 1)'
                 ],
                 borderWidth: 1
             }]
         },
         options: {
             scales: {
                 yAxes: [{
                     ticks: {
                         beginAtZero:false
                     }
                 }]
             },
             maintainAspectRatio:true,
             annotation: {
              events: ["click"],
              annotations: [
                {
                  drawTime: "afterDatasetsDraw",
                  id: "hline",
                  type: "line",
                  mode: "horizontal",
                  scaleID: "y-axis-0",
                  value: 11000, //payload.predictionInfo.predictedPrice
                  borderColor: "black",
                  borderWidth: 5,
                  label: {
                    backgroundColor: "red",
                    content: "Test Label",
                    enabled: true
                  },
                  onClick: function(e) {
                    // The annotation is is bound to the `this` variable
                    console.log("Annotation", e.type, this);
                  }
                },
                /*{
                  drawTime: "beforeDatasetsDraw",
                  type: "box",
                  xScaleID: "x-axis-0",
                  yScaleID: "y-axis-0",
                  xMin: "February",
                  xMax: "April",
                  yMin: randomScalingFactor(),
                  yMax: randomScalingFactor(),
                  backgroundColor: "rgba(101, 33, 171, 0.5)",
                  borderColor: "rgb(101, 33, 171)",
                  borderWidth: 1,
                  onClick: function(e) {
                    console.log("Box", e.type, this);
                  }
                }*/
              ]
            }
         },
     });
   };

   // Display some basic information about the prediction.
   var _initializePredictionInfo = function(){
      daysPlural="";
      if(payload.predictionInfo.predictionDays>1){
        daysPlural = "s";
      }

      predictionStatus="";
      if(payload.predictionInfo.processed == 0){ // if it hasnt been processed than its still active.
        predictionStatus = "Still Ongoing";
      }else{
        predictionStatus = "Completed";
      }

      var html = $('<ul class="list-group"></ul>');
      var li1 = "Prediction made: "+dateUtilities.getMDYDate(payload.predictionInfo.timestamp)+", Ends: "+dateUtilities.getMDYDate(payload.predictionInfo.expires)+", Timeframe: " + payload.predictionInfo.predictionDays + " day"+daysPlural; 
      html.append($('<li class="list-group-item">'+li1+'</li>'));
      
      var currentPrice = "Price at time of prediction: $"+numberUtilities.numberWithCommas(numberUtilities.round(payload.predictionInfo.currentPrice, 0)); 
      html.append($('<li class="list-group-item">'+currentPrice+'</li>'));

      var predictedPrice = "Predicted price: $"+numberUtilities.numberWithCommas(numberUtilities.round(payload.predictionInfo.predictedPrice, 0)); 
      html.append($('<li class="list-group-item">'+predictedPrice+'</li>'));

      var percentage = "Percentage difference: "+payload.predictionInfo.percentageDifference; 
      html.append($('<li class="list-group-item">'+percentage+'</li>'));

      var li2 = "Coin: "+payload.predictionInfo.coinSymbol+", Currency: "+payload.predictionInfo.currencySymbol+", Status: "+predictionStatus; 
      html.append($('<li class="list-group-item">'+li2+'</li>'));

      var liReason = "Reason: "+payload.predictionInfo.reason; 
      html.append($('<li class="list-group-item">'+liReason+'</li>'));

      $("#js-predictionInfo").html(html);
   };
   

   // When page loads. 
   _initializeChart();
   _initializePredictionInfo();

}); // END require


/*class Hello extends React.Component {
	   	render(){
	   		return(
   				React.createElement("div", { className: "container"}, React.createElement("h1"), null, "Getting Started")
	   		);
	   	}
   }
   
   ReactDOM.render(React.createElement(Hello, null), mountNode);*/