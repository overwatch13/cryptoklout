<?php

class Custom extends Standards {

	function customLogin($post){
		$email = $post['email'];
		$pass = $post['pass'];
    //return array("email"=>$email);
    // additionally, what happens if the user attempts to login for an email that is of type "google"
    // that would be picked up here, but might not work because they do not have a salt value.
    // should this be AND login_type !="google" AND login_type !="facebook" AND login_type !="twitter"
		$sql = "SELECT salt FROM user WHERE email='" . $email . "'";
		$query = $this->query($sql, 'fetch');
		if($query){
			$user = $query[0];
      // Not sure if we should attach the active state criteria there, what if they are not active yet?
			$selectData = "select * from user where email='".$email."' AND password='". sha1($user['salt'] . $pass)."' AND active='Active'";
			$query = $this->query($selectData, 'fetch');
			if(count($query) > 0) {
				session_start();
				$_SESSION['email'] = $query[0]['email'];
				$_SESSION['userId'] = $query[0]['id'];
				//return header("Location: /");
				return array("success"=>true);
			}
			else {
				//return header('Location: '.$siteurl.'?error=login');
				return array("success"=>false);
			}
		}
		else {
			// fail
			//return header('Location: '.$siteurl.'?error=login');
			return array("success"=>false);
		}

	} // end customLogin()

	function customRegister($post) {
		$email = $post['email'];
		$pass = $post['password'];
		$selectData = "select * from user where email='".$email."'"; // Does it matter which type they are?
    // what is we find a google email?
		$query = $this->query($selectData, 'fetch');
		if(count($query) > 0) {
			// return header('Location: '.$siteurl.'?error=registeral');
			// This is where you would need to do something to tell the user that the account already exists.

			// If the email exists, do we need logic to see whether it is of type Google, Twitter or Facebook?
			// If it already exists, is not the big three and has not been activated yet, should we resend the confirmation link?

			return array(
				"success"=>false,
				"case"=>"emailExists");

		}
		else {
				session_start(); // should we even start session here if we do not know if they exist yet?    //
				$salt = time();
				$pw = sha1($salt . $pass);
				$queryR="INSERT INTO user (email,password,login_type, salt, created) VALUES ('$email','".$pw."', 'custom', $salt, $salt)";
				$queryInsert = $this->query($queryR);

				$register_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?isActive=Yes&id=" . base64_encode($email);
				$to = $email;
				$subject = "CryptoKlout User Registration Activation Email";
				$content = "Click this link to activate your account. <a href='" . $register_link . "'>" . $register_link . "</a>";

				// Send out the email
				$headers = 'MIME-Version: 1.0' . "\r\n". 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		    $headers .= 'From: CryptoKlout Email Registration <no-reply@cryptoklout.com>' . "\r\n";
		    mail($to,$subject,$content,$headers); // this should be $content,

				// return header('location:'.$siteurl.'?success=activation');
				return array(
					"success"=>true,
					"case"=>"regsisterSuccess");
		}
	}

	function customForgot($email) {
		$selectData = "select * from user where email='".$email."' AND active='Active'";
		$queryR = $this->query($selectData, 'fetch');
		if(count($queryR) > 0) {
			$forogt_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?forgot=Yes&id=" . base64_encode($email);
			$toEmail = $email;
			$subject = "Forgot password Email";
			$content = "Click this link to change your password. <a href='" . $forogt_link . "'>" . $forogt_link . "</a>";
			// SendGrid Initialization
			$apiKey = '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';
			$sendgridId = new \SendGrid($apiKey);
			//Student Notification Email - Login Details
			  $to = new SendGrid\Email('test', $email);
			  $from = new SendGrid\Email('Cryptoklout', 'cryptoklout@gmail.com');
			  $subject = 'Forgot password Email';
			  $email_body = $content;
			  $htmlWrapper = "<html><body>$email_body</body></html>";
			  $content = new SendGrid\Content('text/html', $htmlWrapper);
			  $mail = new SendGrid\Mail($from, $subject, $to, $content);
			  $responseSendGrid = $sendgridId->client->mail()->send()->post($mail);
			 return header('location:'.$siteurl.'?success=fmailsent');
		} else {
			return header('location:'.$siteurl.'?error=forgot');
		}
	}

	function customChange($pass,$conpass) {
		$email = base64_decode($_REQUEST['id']);
		if($pass == $conpass) {
			//$pass = md5($pass);
			$time = time();
			$pass = sha1($time . $pass);
			$update="UPDATE user SET password='$pass', salt=" . $time . " WHERE email='$email'";
			$queryR = $this->query($update);
			return header('location:'.$siteurl.'?success=password');
		} else {
			return header('location:'.$siteurl.'?error=passwordnot&id='.$_REQUEST['id']);
		}
	}

	function IsActive() {
		$email = base64_decode($_REQUEST['id']);
		$update="UPDATE user SET active='Active' WHERE email='$email' AND active='DeActive'";
		$queryR = $this->query($update);
	}

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
