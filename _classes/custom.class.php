<?php
class Custom extends Standards {
	
	function customLogin($email,$pass) {
		session_start();
		$selectData = "select * from user where email='".$email."' AND password='".$pass."' AND active='Active'";
		$query = $this->query($selectData, 'fetch');
		if(count($query) > 0) {
			$_SESSION['email'] = $query[0]['email'];
			return header("Location: /");
		}
		else {
			return header('location:'.$siteurl.'?error=login');
		}
	}

	function customRegister($email,$pass) {
		session_start();
		$selectData = "select * from user where email='".$email."'";
		$query = $this->query($selectData, 'fetch');
		if(count($query) > 0) {
			return header('location:'.$siteurl.'?error=registeral');
			// This is where you would need to do something to tell the user that the account already exists. 
		}
		else {
			$queryR="INSERT INTO user(email,password,login_type) VALUES ('$email','".$pass."', 'custom')";
			$queryInsert = $this->query($queryR);
			$register_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?isActive=Yes&id=" . base64_encode($email);
			$toEmail = $email;
			$subject = "User Registration Activation Email";
			$content = "Click this link to activate your account. <a href='" . $register_link . "'>" . $register_link . "</a>";
			// SendGrid Initialization
			$apiKey = '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';
			$sendgridId = new \SendGrid($apiKey);
			$to = new SendGrid\Email('test', $toEmail);
			$from = new SendGrid\Email('CryptoKlout', 'cryptoklout@gmail.com');
			$subject = 'User Registration Activation Email';
			$email_body = $content;
			// Create an email class, and run this through the class so it is part of a standard template.
			$htmlWrapper = "<html><body>$email_body</body></html>";
			$content = new SendGrid\Content('text/html', $htmlWrapper);
			$mail = new SendGrid\Mail($from, $subject, $to, $content);
			$responseSendGrid = $sendgridId->client->mail()->send()->post($mail);
			return header('location:'.$siteurl.'?success=activation');
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
			$pass = md5($pass);
			$update="UPDATE user SET password='$pass' WHERE email='$email'";
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
			$Insert="INSERT INTO user(email,active,login_type) VALUES ('$email', 'Active', 'facebook')";
			$this->query($Insert);
		}
		if(isset($_SESSION)) {
			return 1;
		}
	}
}
