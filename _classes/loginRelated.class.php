<?php

class Custom extends Standards {

	function customLogin($post){
		$email = $post['email'];
		$pass = $post['password'];
		$sql2="";
		$query2="";
		$success = false;
		$case = ""; // this is a string value for javascript to render proper login on ui "foundGoogle"
		$responseMessage = "";

		$sql = "SELECT * FROM user WHERE email='" . $email . "'";
		$query = $this->query($sql, 'fetch');

		// A user was found
		if(sizeof($query)>0){
			$userInfo = $query[0];
			// The success case is when they have a password, we attempt to log them in.
			if($userInfo['password'] !==null && $userInfo['password'] !=="" && $userInfo['active'] == "Active"){
				// They have a password, and we are not waiting for email verification, Not verify the password. is correct.
				$sql2 = "select * from user where email='".$email."' AND password='". sha1($userInfo['salt'] . $pass)."' AND active='Active'";
				$query2 = $this->query($sql2, 'fetch');
				if(count($query) > 0) {
					session_destroy();
					session_start();
					$_SESSION['email'] = $query[0]['email'];
					$_SESSION['userId'] = $query[0]['id'];
					$_SESSION['login_type'] = 'custom';
					$success = true;
					$case = "LogUserIn";
				}
			}else if($userInfo['password'] !==null && $userInfo['password'] !=="" && $userInfo['active'] == "DeActive"){
				// sends the user another confirmation link
				$EmailClass = new Email();
				$EmailClass->sendConfirmationEmail($email);
				$case = "warning";
				$responseMessage = "We have sent a confirmation link to the email address specified, please check your inbox and spam folder.";
			}
			// Case when a user has logged in before with a social login, but does not have a password
			// We want them to do a forgot password process, so we can verify them and set a new password if one does not exist.
			else if(($userInfo['login_type']=="facebook" || $userInfo['login_type']=="twitter" || $userInfo['login_type']=="google") && ($userInfo['password']==null || $userInfo['password'] =="")) {
				$case = "warning";
				$responseMessage = "That email is taken, try forgot password.";
			}
		}else{
			// A User was not found, send back a message to them.
			$case = "warning";
			$responseMessage = "We do not have record of that email address.";
		}

		$return = array(
			"success"=>$success,
			"query"=>$query,
			"sql2"=>$sql2,
			"query2"=>$query2,
			"case"=>$case,
			"responseMessage"=>$responseMessage,
		);
		return $return;
	} // end customLogin()

	// *** FORGOT PASSWORD ***
	function customForgotPasswordSend($post) {
		$email = $post['email'];
		$success = false;
		$case = ""; // this is a string value for javascript to render proper login on ui "foundGoogle"
		$responseMessage = "";

		$selectData = "select * from user where email='".$email."' ";
		$queryR = $this->query($selectData, 'fetch');

		if(count($queryR) > 0){
			$user = $queryR[0];
			$EmailClass = new Email();
			$EmailClass->sendForgotPasswordEmail($user['email'], $user['hashVerificationToken']);
			$case = "warning";
			$responseMessage = "A forgot password email was sent. Please check your inbox and spam folder.";
		}

		// a link will be sent to their email like so...
		// http://localhost.cryptoklout.com/?forgot=Yes&id=dGVzdDkwN0BtYWlsaW5hdG9yLmNvbQ==&hashVerificationToken=70fcedb0e2e6bc7f8402dcb174b44b9ebd8f9b0e
		// this will fire off, js/modules/modalHandler.js, to bring up the change password form.
		// When that is submitted, that will fire off customChangePassword() in this class.

		$return = array(
			"success"=>$success,
			//"query"=>$query,
			"case"=>$case,
			"responseMessage"=>$responseMessage,
		);
		return $return;
	}

	// fires after they submit a new password, from modal.
	function customChangePassword($post){
		// What is just stopping someone from doing
		// http://localhost.cryptoklout.com/?forgot=Yes&id=d2lsbGlhbWhvd2xleUBnbWFpbC5jb20=
		// adding a url, and than this function would be logging them in.
		$email = base64_decode($post['email']); // this is a base64_encode string at this point. Need clarification on whether this is secure.
		$hashVerificationToken = $post['hashVerificationToken'];
		$password = $post['password'];
		$case = ""; // this is a string value for javascript to render proper login on ui "foundGoogle"
		$responseMessage = "";
		$userId = "";

		$sql = "SELECT * FROM user WHERE email='" . $email . "'";
		$query = $this->query($sql, 'fetch');

		if(sizeof($query)>0){
			$userInfo = $query[0];
			if($userInfo['hashVerificationToken'] == $hashVerificationToken){
				$salt = time();
				// As of right here, not every user has a salt value, not sure if they are getting them.
				$sql = "UPDATE user SET salt='".$salt."', password='". sha1($salt . $password)."', active='Active' WHERE email='".$email."' ";
				$this->query($sql);
				session_destroy(); // somehow, there is a session already started but I cant find it.
				session_start(); // auto log them in.
				$_SESSION['email'] = $email;
				$_SESSION['userId'] = $userInfo['id'];
				$_SESSION['login_type'] = 'custom';
				$userId = $userInfo['id'];
				$case = "routeUserToProfilePage";
			}else{
				// we couldnt match the hashVerificationToken
			}
		}else{
			// A User was not found, send back a message to them.
			$case = "warning";
			$responseMessage = "The specified email was not found.";
		}

		$return = array(
			"sql"=>$sql,
			"query"=>$query,
			"case"=>$case,
			"id"=>$userId,
			"responseMessage"=>$responseMessage,
		);
		return $return;
	} // end changePassword

	// User registration
	function customRegister($post) {
		$email = $post['email'];
		$pass = $post['password'];
		$success = false;
		$case = ""; // this is a string value for javascript to render proper login on ui "foundGoogle"
		$responseMessage = "";

		$selectData = "select * from user where email='".$email."'"; // Does it matter which type they are?
    // what is we find a google email?
		$query = $this->query($selectData, 'fetch');
		if(count($query) > 0) {
			$case = "warning";
			$responseMessage = "That email address is already in use.";
		}else {
				$salt = time();
				$scrambledPassword = sha1($salt . $pass);
				$hashVerificationToken = sha1(time() . rand(1,10000)); // used for appending to verification email url.
				$queryR="INSERT INTO user (email, password, login_type, salt, created, hashVerificationToken) VALUES ('".$email."','".$scrambledPassword."', 'custom', ".$salt.", ".$salt.", '".$hashVerificationToken."')";
				$userId = $this->query($queryR, 'id');

				// Insert a record into all other required tables.
				$this->addOnAdditionalTablesForNewUser($userId);

				// send confirmation email
				$EmailClass = new Email();
				$EmailClass->sendConfirmationEmail($email, $hashVerificationToken);
				$success = true;
				$case = "success";
				$responseMessage = "Please check your email or spam folder for an email confirmation link.";
		}

		$return = array(
			"success"=>$success,
			//"sql"=>$sql,
			//"query"=>$queryR,
			//"id" => $queryInsert,
			"case"=>$case,
			"responseMessage"=>$responseMessage,
		);
		return $return;
	}// end customRegister()


	// When the user clicks on an activation link from an email, it starts a new browser,
	// and loginAuth.php picks up on the isActive flag.
	// http://localhost.cryptoklout.com/?isActive=Yes&activate=dGVzdDU0NkBtYWlsaW5hdG9yLmNvbQ==
	// The loginAuth.php than fires the IsActive() function here.
	// There are still some security risks here because it is only being base64_encode d.
	function activateAccountFromUrl() {
		// This is responsible for taking the activation link, seeing if the account exists,
		// also add onto the confirmation link a sha1 hash, which will be a combination of two radom things.
		$email = base64_decode($_REQUEST['activate']);
		$hashVerificationToken = $_REQUEST['hashVerificationToken'];
		$sql = "SELECT * FROM user WHERE email='" . $email . "'";
		$query = $this->query($sql, 'fetch');

		if(sizeof($query)>0){
			$userInfo = $query[0];
			if($userInfo['hashVerificationToken'] == $hashVerificationToken){ // there is a match of tokens!
				$sql="UPDATE user SET active='Active' WHERE email='$email' ";
				$queryR = $this->query($sql, 'id');
				session_destroy();
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['userId'] = $userInfo['id'];
				$page = "http://".$_SERVER['SERVER_NAME']."/pages/predictions/prediction-choices.php";
				header('Location: '.$page);
			}else{
				// the token do not match, so something is wrong, do not update their account or log them in.
			}
		}else{
			// something has gone horribly wrong but we have no way of telling the user.
		}
	}

	// This function should be accessed after the user has created a new account and has a userId.
	// Any time there is a dependent table that much exist such as predictor_timing_limitations
	// you should add its instantiation here. This way, there is a record for the user in these meta tables,
	// and thus wont throw an error when they try to access a page that requires there to be a record for them.
	function addOnAdditionalTablesForNewUser($userId){
		$sql="INSERT INTO predictor_timing_limitations (userId) VALUES (".$userId.")";
		$this->query($sql);
	}

	// Doesnt look like this belongs here, figure out what is going on with this.
	function facebookLogin($email) {
		session_start();
		//Storing user data into session
		$_SESSION['email'] = $email;
		$selectData = "select * from user where email='".$email."'";
		$query = $this->query($selectData, 'fetch');
		if(count($query) == 0) {
			$time = time();
			$Insert="INSERT INTO user(email,active,login_type, created) VALUES ('$email', 'Active', 'facebook', $time)";
			$this->query($Insert);
		}
		if(isset($_SESSION)) {
			return 1;
		}
	}
}
