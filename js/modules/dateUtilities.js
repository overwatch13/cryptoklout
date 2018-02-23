define([], function () {
   var getTodaysDate = function() {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1; //January is 0!
      var yyyy = today.getFullYear();
      if (dd < 10) {
         dd = '0' + dd
      }
      if (mm < 10) {
         mm = '0' + mm
      }
      today = yyyy + '-' + mm + '-' + dd;
      return today;
   };


   var getDateTime = function() {
      var now = new Date();
      var year = now.getFullYear();
      var month = now.getMonth() + 1;
      var day = now.getDate();
      var hour = now.getHours();
      var minute = now.getMinutes();
      var second = now.getSeconds();
      if (month.toString().length == 1) {
         var month = '0' + month;
      }
      if (day.toString().length == 1) {
         var day = '0' + day;
      }
      if (hour.toString().length == 1) {
         var hour = '0' + hour;
      }
      if (minute.toString().length == 1) {
         var minute = '0' + minute;
      }
      if (second.toString().length == 1) {
         var second = '0' + second;
      }
      var dateTime = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
      return dateTime;
   }

   var getDateByNumber = function(todaysDate, number) {
      var today = new Date()
      var dateResult = new Date().setDate(today.getDate() + number); // number can be negative here. 
      var newDate = new Date(dateResult);
      return newDate;
   }


   // We use this to complete a date url
   var getMDYDate = function(date) {
      if(typeof(date)=="string"){
         date = new Date(date);
      }
      var year = date.getFullYear();
      var month = (1 + date.getMonth()).toString();
      month = month.length > 1 ? month : '0' + month;
      var day = date.getDate().toString();
      day = day.length > 1 ? day : '0' + day;
      return month + '/' + day + '/' + year;
   }

   // We need this format to input for the database.
   var getYYYYMMDDDate = function(date) {
      if(typeof(date)=="string"){
         date = new Date(date);
      }
      var year = date.getFullYear();
      var month = (1 + date.getMonth()).toString();
      month = month.length > 1 ? month : '0' + month;
      var day = date.getDate().toString();
      day = day.length > 1 ? day : '0' + day;
      return year + '-' + month + '-' + day;
   }

   var isDate = function(dateArg) {
      var t = (dateArg instanceof Date) ? dateArg : (new Date(dateArg));
      return !isNaN(t.valueOf());
   }

   var isValidRange = function(minDate, maxDate) {
      return (new Date(minDate) <= new Date(maxDate));
   }

   var betweenDate = function(startDt, endDt) {
      var error = ((isDate(endDt)) && (isDate(startDt)) && isValidRange(startDt, endDt)) ? false : true;
      var between = [];
      if (error) console.log('error occured!!!... Please Enter Valid Dates');
      else {
         var currentDate = new Date(startDt),
            end = new Date(endDt);
         while (currentDate <= end) {
            var tempDate = new Date(currentDate);
            var tempObj = {
               dateRangeMMDDYYYY: getDDMMYYYDate(tempDate),
               dateRangeYYYYMMDD: getYYYYMMDDDate(tempDate)
            }
            between.push(tempObj);
            currentDate.setDate(currentDate.getDate() + 1);
         }
      }

      // Returning two different types of formats for different purposes.
      return between;
   }

   return {
      getTodaysDate:getTodaysDate,
      getDateTime:getDateTime,
      getDateByNumber:getDateByNumber,
      getMDYDate:getMDYDate,
      getYYYYMMDDDate:getYYYYMMDDDate,
      isDate:isDate,
      isValidRange:isValidRange,
      betweenDate:betweenDate,
   }

}); // END require

