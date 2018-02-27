define(["jqueryValidate"], function (jqueryValidate) {
   $registerModalForm = $("#registerModalForm");
   $userSignInFormId = $("#user-sign-in-form-id");
   $forgotPasswordForm = $("#forgot-password-form");
   $changePasswordModalFormId = $("#changePasswordModalFormId");

    var _handleLoginClick = function(){
      var obj = {
          operation : "userLogin", // for the ajax switch
          function : "userLogin", // function name in the class we want to hit.
          email: $("#userLoginEmail").val(),
          password: $("#userLoginPassword").val(),
      };

      $.post("/ajax-internal.php", obj).done(function(data) {
        try{
          data = $.parseJSON(data);
          _handleSignInResponse(data);
          //window.location.href = window.location.origin + "/pages/predictions/prediction-choices.php";
          //$(".error").html(data)
        }catch (e){
          // if a string was returned its because php threw an error.
          console.log(data);
          //_handleSignUpResponse(null);
          //_sendEmailError(data);
        }
      }).fail(function(data) {
          $(".error").html(data)
      }).always(function() {
          $.unblockUI();
      });
    };

  var _handleForgotPasswordClick = function(){
    var obj = {
        operation : "userForgotPassword", // for the ajax switch
        function : "userForgotPassword", // function name in the class we want to hit.
        email: $("#forgot-password-input-email").val(),
    };

    $.post("/ajax-internal.php", obj).done(function(data) {
      try{
        data = $.parseJSON(data);
        _handleAjaxResponse(data);
        //window.location.href = window.location.origin + "/pages/predictions/prediction-choices.php";
        //$(".error").html(data)
      }catch (e){
        // if a string was returned its because php threw an error.
        console.log(data);
        //_handleSignUpResponse(null);
        //_sendEmailError(data);
      }
    })
  };

  var _changePasswordSubmission = function(){
    var obj = {
        operation : "userChangedPassword", // for the ajax switch
        function : "userChangedPassword", // function name in the class we want to hit.
        email: $("#changePasswordModalEmail").val(), // this is a base64_encode  value string.
        password: $("#changePasswordModalPassword1").val(),
    };

    $.post("/ajax-internal.php", obj).done(function(data) {
      try{
        data = $.parseJSON(data);
        _handleAjaxResponse(data);
        //window.location.href = window.location.origin + "/pages/predictions/prediction-choices.php";
        //$(".error").html(data)
      }catch (e){
        // if a string was returned its because php threw an error.
        console.log(data);
        //_handleSignUpResponse(null);
        //_sendEmailError(data);
      }
    });
  };

  // When a user is attempting to register.
  var _userRegisterClick = function(){
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
         _handleAjaxResponse(data);
       }catch (e){
         // if a string was returned its because php threw an error.
         console.log(data);
         _handleSignUpResponse(null);
         _sendEmailError(data);
       }
    });
  };

  // The other handlers can be converted to this one. This one can work for all of them.
  var _handleAjaxResponse = function(data){
    $registerResponse = $('.registerResponse:visible');
    $registerResponse.html('');
    if(data == null){
      $registerResponse.append($('<div class="warning-msg danger">The server did not respond correctly.</div>'));
    }else if(data.case == "warning"){
      $registerResponse.append($('<div class="warning-msg warning">'+data.responseMessage+'</div>'));
    }else if(data.success == true && data.case == "routeUserToProfilePage" && (data.hasOwnProperty("id") && data.id !=="")){
      window.location.href = window.location.origin + "/predictor/" + data.id;
      //console.log(data);
    }else if(data.success == true && data.case == "routeUserToPredictionChoices"){
      // currently a successful registration brings them to the prediction page first.
      //window.location.href = window.location.origin + "/pages/predictions/prediction-choices.php";
      console.log(data);
    }
  };

  // Handle Sign in Response
  // Refactor this to use the _handleAjaxResponse
  var _handleSignInResponse = function(data){
    console.log(data);
    $registerResponse = $('.registerResponse:visible');
    $registerResponse.html();
    if(data == null){
      $registerResponse.append($('<div class="warning-msg danger">Something has gone terribly wrong.</div>'));
    }else if(data.case == "warning"){
      $registerResponse.append($('<div class="warning-msg warning">'+data.responseMessage+'</div>'));
    }else if(data.success == true && data.case == "LogUserIn"){
      console.log("user is logged in, bring them to the appropriate page.");
      window.location.href = window.location.origin + "/pages/predictions/prediction-choices.php";
    }
  };

   // Response from user trying to New Register.
   // Refactor this to use the _handleAjaxResponse
   var _handleSignUpResponse = function(data){
     $registerResponse = $('.registerResponse:visible');
     $registerResponse.html('');
     if(data == null){
       $registerResponse.append($('<div class="warning-msg danger">The server did not respond correctly.</div>'));
     }else if(data.success == false && data.case == "emailExists"){
       $registerResponse.append($('<div class="warning-msg warning">The email address already exists.</div>'));
     }
   };

   // *** Form Validations ***
   var _loginFormValidation = function(){
      $userSignInFormId.validate({
          onkeyup: false,
          rules: {
              email: { required: true},
              password: { required: true},
          },
          messages: {
              email: { required: "An email is required."},
              password: { required: "A password is required."}
          }
      });
   };

   var _signUpFormValidation = function(){
      $registerModalForm.validate({
          onkeyup: false,
          rules: {
              email: { required: true},
              password: { required: true},
          },
          messages: {
              email: { required: "An email is required."},
              password: { required: "A password is required."}
          }
      });
   };

   var _forgotPasswordFormValidation = function(){
      $userSignInFormId.validate({
          onkeyup: false,
          rules: {
              email: { required: true},
          },
          messages: {
              email: { required: "An email is required."},
          }
      });
   };

   var _changePasswordFormValidation = function(){
      $changePasswordModalFormId.validate({
          onkeyup: false,
          rules: {
              password1: {
                required: true,
                minlength:5,
              },
              password2: {
                required: true,
                equalTo: "#changePasswordModalPassword1",
                minlength:5,
              },
          },
          messages: {
              password1: { required: "A new password is required."},
              password2: { required: "Confirm password is required."},
          }
      });
   };


   // When php fails, it sends back a string that we can email to my self. PHP's error handling is subpar.
   var _sendEmailError = function(data){
     var obj = {
       operation : "sendEmailWarning",
       message: data,
     };

     $.post("/ajax-internal.php", obj).done(function(data) {
       console.log(data);
     });
   };



   // **** Click Events ****

   // #js-login-btn click
   $("#js-login-btn").on("click",function(e){
    e.preventDefault();
    $('.registerResponse:visible').html('');
    _loginFormValidation();

     if($userSignInFormId.valid()){
       _handleLoginClick();
     }else{
       console.log("form is invalid")
     }
   });

   $("#js-submit-forgot-password-btn").on("click",function(e){
    e.preventDefault();
    $('.registerResponse:visible').html('');
    _forgotPasswordFormValidation();

     if($forgotPasswordForm.valid()){
       _handleForgotPasswordClick();
     }else{
       console.log("form is invalid")
     }
   }); // end #js-login-btn click

   // Change Password submit btn, from change password modal.
   $("#changePasswordModalSubmitBtn").on("click",function(e){
      e.preventDefault();
      $('.registerResponse:visible').html('');
      _changePasswordFormValidation(); // YOU ARE HERE, SETTING THIS FUNCTION

       if($changePasswordModalFormId.valid()){
         _changePasswordSubmission();
       }else{
         console.log("form is invalid")
       }
   });

   // User Register function
   $("#js-user-register").on("click",function(e){
     e.preventDefault();
     $('.registerResponse:visible').html('');
     _signUpFormValidation();
     if($registerModalForm.valid()){
       _userRegisterClick();
     }else{
       console.log("form is invalid")
     }
   }); // // User Register function

}); // END require
