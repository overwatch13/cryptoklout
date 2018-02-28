define([], function () {
  var _initiateGoogleLogin = function(){
    var obj = {
        operation : "googleLogin", // for the ajax switch
        function : "googleLogin", // function name in the class we want to hit.
        //email: $("#forgot-password-input-email").val(),
    };

    $.post("/ajax-internal.php", obj).done(function(data) {
      try{
        data = $.parseJSON(data);
        console.log(data);
        //_handleAjaxResponse(data);
      }catch (e){
        console.log(data);
      }
    });
  };

   // *** Click Events ***
   $("#js-googleSignInBtn").on("click", function(){
      _initiateGoogleLogin();
   });

}); // END require
