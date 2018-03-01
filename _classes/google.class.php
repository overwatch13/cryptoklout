<?php

// This was written by Brian on 2/18/2018, we are attempting to move away from this library and completely re-write it.
class Google extends Standards {
	function googleLogin() {
		// this would be ideal if we could ajax into this request.
		if(!isset($_REQUEST['oauth_verifier'])) {
			if(!isset($_REQUEST['facebook'])) {

				if(isset($_SESSION)){
					session_destroy();
				}
				session_start();
				/*
				 * Configuration and setup Google API
				 */
				$clientId = '242654526823-bq03e8lr39tmu6pah8i5298bge2l9rgv.apps.googleusercontent.com'; //Google client ID
				$clientSecret = 'nyR-ZNad4taOcqGDGw11jz9c'; //Google client secret
				$redirectURL = "http://".$_SERVER['SERVER_NAME'];

				//Call Google API
				$gClient = new Google_Client();
				$gClient->setApplicationName('Klout');
				$gClient->setClientId($clientId);
				$gClient->setClientSecret($clientSecret);
				$gClient->setRedirectUri($redirectURL);

				$google_oauthV2 = new Google_Oauth2Service($gClient);

				// Not understanding how this is working, only thing I can think of is when we hit their url we are somehow getting the get code There
				// which makes no sense.
				// https://accounts.google.com/o/oauth2/auth?response_type=code
				// &redirect_uri=http%3A%2F%2Flocalhost.cryptoklout.com
				// &client_id=242654526823-bq03e8lr39tmu6pah8i5298bge2l9rgv.apps.googleusercontent.com
				// &scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email
				// &access_type=offline&approval_prompt=force
				// Not sure if this belongs here. arggg.

				if(isset($_GET['code'])) {
					$gClient->authenticate($_GET['code']); // why would we have a get variable at this point?
					$_SESSION['token'] = $gClient->getAccessToken();
					header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
					exit(); // without the exit, the rest of the script was still running.
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

					// Are we allowed to save this information to our own database? Do we even want too?

					$_SESSION['email'] = $gpUserProfile['email'];
					$_SESSION['displayName'] = $gpUserProfile['given_name'];
					$_SESSION['login_type'] = 'google';

					$selectData = "SELECT * FROM user WHERE email='".$gpUserProfile['email']."'";
					$query = $this->query($selectData, 'fetch');

					// if the query could not find the email, than we create a new account for them.
					// But what happens if they do find an email but it is of type custom?
					// it is alsmost as if we would need to have a column that tracks what types of login they have for each.
					if(count($query) == 0) {
						$time = time();
						$insertUser="INSERT INTO user(email,active,login_type,created) VALUES ('$gpUserProfile[email]', 'Active', 'google', " . $time . ")";
						$userId = $this->query($insertUser, 'id');
						$_SESSION['userId'] = $userId;

						$sql = "INSERT INTO user_info (userId, first_name, last_name, locale, picture, link) ";
						$sql .= " VALUES (".$userId.", '".$gpUserProfile['given_name']."', '".$gpUserProfile['family_name']."', '".$gpUserProfile['locale']."', '".$gpUserProfile['picture']."', '".$gpUserProfile['link']."') ";
						$this->query($sql);

						//  adds record a new record into:
						//  predictor_timing_limitations, user_crypto_score
						$customClass = new Custom();
						$customClass->addOnAdditionalTablesForNewUser($userId);
					}else{
						// case where an email and userId was found.
						$userId = $query[0]['id'];
						$_SESSION['userId'] = $userId;
					}


					// See if a record exists in the user_info table.
					// if It does exist not exist, than insert it, if it does exist, than update it.
					// I could not user an insert / update sql statement because it is not running off of key, it is running off of userId
					$sql = "SELECT * FROM user_info WHERE userId='".$userId."'";
					$query = $this->query($selectData, 'fetch');
					if(sizeof($query)==0){
						// We found a record, so do an update.
						// !!!!!! this ENTIRE FUNCTION IS FIRING TWICE. NO IDEA WHY
						$sql = "INSERT INTO user_info (userId, first_name, last_name, locale, picture, link) ";
						$sql .= " VALUES (".$userId.", '".$gpUserProfile['given_name']."', '".$gpUserProfile['family_name']."', '".$gpUserProfile['locale']."', '".$gpUserProfile['picture']."', '".$gpUserProfile['link']."') ";
						$this->query($sql);
					}else{
						// We did not find a record, do an insert, similar to above.
						$sql = "UPDATE user_info SET first_name='".$gpUserProfile['given_name']."', last_name='".$gpUserProfile['family_name']."', locale='".$gpUserProfile['locale']."', picture='".$gpUserProfile['picture']."', link='".$gpUserProfile['link']."' WHERE userId=".$userId;
						$this->query($sql);
					}

				} else {
					// Creates the facebook button with the proper url if a bunch of request types do not exist, including the facebook one.
					$authUrl = $gClient->createAuthUrl();
					return '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><i class="fa fa-google" aria-hidden="true"></i> <span>Sign in with Google</span></a>';
				}
			}
		}
	}
}
