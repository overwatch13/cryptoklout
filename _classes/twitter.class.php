<?php
class Twitter extends Standards {
	// initial notes on twitter login.
	// I can see a lot of problems with this, for one, it is all php based,
	// we would need to refactor this to be a mix between js,ajax,php, and than back again so we can display various responses or errors.
	// secondly, when we get a response from twitter we are inserting them based on email address,
	// well what happens if that person us using the same email address for google? wont it not be able to insert?
	// separately, there are a bunch of errors on the authorize screen, not sure why.
	// do we just abandon this for now, so you can make some more progress with what you are doing?

	function twitterLogin() {
		define('CONSUMER_KEY', 'et0ETfvrpbg9GMXwKK4syrCJE'); // YOUR CONSUMER KEY
		define('CONSUMER_SECRET', 'sTSnCXv3muOv0YNPkAhlmJU4rB9bMujafG6Jb9wl4OXCexYNtu'); //YOUR CONSUMER SECRET KEY
		$redirectUrl = "http://".$_SERVER['SERVER_NAME'];
		define('OAUTH_CALLBACK', $redirectUrl);  // Redirect URL

		if(isset($_GET['request']) && $_GET['request'] == "twitter")
		{
				//Fresh authentication
				$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
				$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

				//Received token info from twitter
				$_SESSION['token'] 			= $request_token['oauth_token'];
				$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];

				//Any value other than 200 is failure, so continue only if http code is 200
				if($connection->http_code == '200')
				{
					//redirect user to twitter
					$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
					header('Location: ' . $twitter_url);
				} else {
					die("error connecting to twitter! try again later!");
				}
		}
		if(isset($_REQUEST['oauth_token'])) {
			session_destroy();
			session_start();
		}

		if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {
			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
			$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
			if($connection->http_code == '200')
			{
				$user_data = $connection->get('account/verify_credentials',["include_entities" => true, "include_email" => "true"]);
				$sql = "SELECT * FROM user email='".$user_data['email']."'";
				$query = $this->query($sql, 'fetch');
				if(count($query) == 0) {
					$insertUser="INSERT INTO user(email,active,login_type) VALUES ('$user_data[email]', 'Active', 'twitter')";
					$query = $this->query($insertUser, 'id');
				}else{
					// somehow see if this is working or not.
				}
				$_SESSION['email'] = $user_data['email'];
				$_SESSION['userId'] = $query; // brings back their user id, I am assuming that this is not working because it brings back 0

			} else {
				   die("error, try again later!");
			}
		} else {
			//Display login button
			return '<a href="/?request=twitter"><i class="fa fa-twitter" aria-hidden="true"></i> <span>Login with Twitter</span></a>';
		}
	}
}
