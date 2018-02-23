<?php
class Twitter extends Standards {
	
	function twitterLogin() {
		define('CONSUMER_KEY', ''); // YOUR CONSUMER KEY
		define('CONSUMER_SECRET', ''); //YOUR CONSUMER SECRET KEY 
		define('OAUTH_CALLBACK', 'http://cryptoklout.com/');  // Redirect URL 

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
					$query = $this->query($insertUser);					
				}
				$_SESSION['email'] = $user_data['email'];			
			} else {
				   die("error, try again later!");
			}
		} else {
			//Display login button
			return '<a href="index.php?request=twitter"><i class="fa fa-twitter" aria-hidden="true"></i> <span>Login with Twitter</span></a>';
		}
	}
}
