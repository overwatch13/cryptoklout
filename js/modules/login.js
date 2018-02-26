define([], function () {
   $("#js-login-btn").on("click",function(e){
     e.preventDefault();
     var obj = {
         operation : "userLogin", // for the ajax switch
         function : "userLogin", // function name in the class we want to hit.
         email: $("#userLoginEmail").val(),
         password: $("#userLoginPassword").val(),
     };

     $.post("/ajax-internal.php", obj).done(function(data) {
         data = $.parseJSON(data);
         console.log(data)
         //window.location.href = window.location.origin + "/pages/predictions/prediction-choices.php";
         //$(".error").html(data)
     }).fail(function(data) {
         $(".error").html(data)
     }).always(function() {
         $.unblockUI();
     });
   });

   // Register function
   $("#js-user-register").on("click",function(e){
     e.preventDefault();
     $('#registerResponse').html(''); // clears previous message if there was one.
     var obj = {
         operation : "userRegister", // for the ajax switch
         function : "userRegister", // function name in the class we want to hit.
         email: $("#user-register-email-address").val(),
         password: $("#user-register-password").val(),
     }
     $.blockUI({ css: { backgroundColor: '#7E7E7E', color: '#fff' },  message: '<h1>Working</h1>' });

     $.post("/ajax-internal.php", obj).done(function(data) {
        $.unblockUI();
        try{
          data = $.parseJSON(data);
          console.log(data)
          _handleSignUpResponse(data);
          //window.location.href = window.location.origin + "/pages/predictions/prediction-choices.php";
          //$(".error").html(data)
        }catch (e){
          // if a string was returned its because php threw an error.
          console.log(data);
          _handleSignUpResponse(null);
          _sendEmailError(data);
        }
     });
   });

   var _handleSignUpResponse = function(data){
     $registerResponse = $('#registerResponse');
     $registerResponse.html();
     if(data == null){
       $registerResponse.append($('<div class="warning-msg danger">The server did not respond correctly.</div>'));
     }else if(data.success == false && data.case == "emailExists"){
       $registerResponse.append($('<div class="warning-msg warning">The email address already exists.</div>'));
     }
   };

   var _sendEmailError = function(data){
     var obj = {
       operation : "sendEmailWarning",
       message: data,
     };

     $.post("/ajax-internal.php", obj).done(function(data) {
       console.log(data);
     });
   };

}); // END require
