<?php

// This is Wills attempt at re-writing the google login oauth code, this is responding to the ajax version.
class GoogleLogin extends Standards {
  function login(){
    $case = "warning";
    $responseMessage = "test";
    $responsePayload = array();

    // Ok, I believe this actually happens on the response BACK from google.
    // You would actually need to create the proper url to reach out to google first...
    
    // if(isset($_SESSION)){
    //   session_destroy();
    // }
    // session_start();
    // /*
    //  * Configuration and setup Google API
    //  */
    // $clientId = '242654526823-bq03e8lr39tmu6pah8i5298bge2l9rgv.apps.googleusercontent.com'; //Google client ID
    // $clientSecret = 'nyR-ZNad4taOcqGDGw11jz9c'; //Google client secret
    // $redirectURL = "http://".$_SERVER['SERVER_NAME'];
    //
    // //Call Google API
    // $gClient = new Google_Client();
    // $gClient->setApplicationName('Klout');
    // $gClient->setClientId($clientId);
    // $gClient->setClientSecret($clientSecret);
    // $gClient->setRedirectUri($redirectURL);
    //
    // $google_oauthV2 = new Google_Oauth2Service($gClient);
    //
    // $responsePayload['GET["code"]'] =  $_GET['code']; // this is not set at this point.
    // if(isset($_GET['code'])) {
    //   $gClient->authenticate($_GET['code']); // why would we have a get variable at this point?
    //   $_SESSION['token'] = $gClient->getAccessToken();
    //   $responsePayload['session_token'] = $gClient->getAccessToken();
    //   // header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
    // }

    $return = array(
      //"query"=>$query,
      //"sql2"=>$sql2,
      "responsePayload"=>$responsePayload,
      "case"=>$case,
      "responseMessage"=>$responseMessage,
    );

    return $return;
  }
}
