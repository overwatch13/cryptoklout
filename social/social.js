
   // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {

    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().

      if (response.status === 'connected') {
        // Logged into your app and Facebook.
          testAPI();
      } else {

      }

  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '717948138411199', // facebook app id
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.12' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

    if($('#is_facebook').val() == null){
      console.log('facebook not enabled');
    } else {
      console.log('facebook enabled');
    }

    // FB.getLoginStatus(function(response) {
    //   statusChangeCallback(response);
    // });

  };



  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  //~

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');

    var full_url = '';
    var last_session_id = '';
    var button_click  = '';

    FB.api('/me?fields=id,first_name,last_name,email,gender,locale,picture', function(response) {
      if(response) {
        $.ajax({
          url: siteurl+'social/facebook.php',
          data: ({ 'id': response.id,'first_name': response.first_name,'last_name': response.last_name,'email': response.email,'gender': response.gender,'locale': response.locale,'picture': response.picture,"full_url":full_url,"last_session_id":last_session_id,"new_session":button_click}),
          //dataType: 'json',
          type: 'post',
          success: function(data) {
            if(data == 1) {
					window.location.href = siteurl;
            } else {
               FB.logout();
            }
          }
        });
      }
    });
  }
