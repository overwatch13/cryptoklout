<?php
class Google extends Standards {

	function googleLogin() {
		if(!isset($_REQUEST['oauth_verifier'])) {
			if(!isset($_POST['submitLogin'])) {
				if(!isset($_POST['submitRegister'])) {
					if(!isset($_REQUEST['facebook'])) {
						session_start();
						/*
						 * Configuration and setup Google API
						 */
						$clientId = '242654526823-bq03e8lr39tmu6pah8i5298bge2l9rgv.apps.googleusercontent.com'; //Google client ID
						$clientSecret = 'nyR-ZNad4taOcqGDGw11jz9c'; //Google client secret
						$redirectURL = 'http://cryptoklout.com';

						// The below is failing, but it should be working to return us to the localhost.
						// says uri mistmatch.  // MAybe it is not allowed to hit the local url or something.
						// I have indeed added this to the authorized redirect urls.
						//((substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http').'://'.$_SERVER["HTTP_HOST"].'/';

						//Call Google API
						$gClient = new Google_Client();
						$gClient->setApplicationName('Klout');
						$gClient->setClientId($clientId);
						$gClient->setClientSecret($clientSecret);
						$gClient->setRedirectUri($redirectURL);

						$google_oauthV2 = new Google_Oauth2Service($gClient);

						if(isset($_GET['code'])) {
							$gClient->authenticate($_GET['code']);
							$_SESSION['token'] = $gClient->getAccessToken();
							header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
						}

						if (isset($_SESSION['token'])) {
							$gClient->setAccessToken($_SESSION['token']);
						}

						if ($gClient->getAccessToken()) {

							$gpUserProfile = $google_oauthV2->userinfo->get();
							$gpUserData = array(
								'oauth_provider'=> 'google',
								'oauth_uid'     => $gpUserProfile['id'],
								'first_name'    => $gpUserProfile['given_name'],
								'last_name'     => $gpUserProfile['family_name'],
								'email'         => $gpUserProfile['email'],
								'locale'        => $gpUserProfile['locale'],
								'picture'       => $gpUserProfile['picture'],
								'link'          => $gpUserProfile['link']
							);

							$_SESSION['email'] = $gpUserProfile['email'];
							$_SESSION['displayName'] = $gpUserProfile['given_name'];

							$selectData = "SELECT * FROM user WHERE email='".$gpUserProfile['email']."'";
							$query = $this->query($selectData, 'fetch');
							// if the query could not find the email, than we create a new account for them.
							if(count($query) == 0) {
								$time = time();
								$insertUser="INSERT INTO user(email,active,login_type,created) VALUES ('$gpUserProfile[email]', 'Active', 'google', " . $time . ")";
								$query = $this->query($insertUser, 'id');
								$_SESSION['userId'] = $query;
								// Instantiate the other necessary tables for them. Insert into predictor_timing_limitations
								// Extract this into its own function, so you can add onto it for new tables in one place, for all types of logins.
								$insertPredictorTiminingLimitations="INSERT INTO predictor_timing_limitations(userId) VALUES (".$query.")";
								$this->query($insertPredictorTiminingLimitations);
							}else{
								$_SESSION['userId'] = $query[0]['id'];
							}
						} else {
							$authUrl = $gClient->createAuthUrl();
							return '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><i class="fa fa-google" aria-hidden="true"></i> <span>Sign in with Google</span></a>';
						}
					}
				}
			}
		}
	}
}
