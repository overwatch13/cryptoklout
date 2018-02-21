<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/sendgrid-php/sendgrid-php.php');

//session_start();

if(!isset($_REQUEST['oauth_verifier'])) {
	if(!isset($_POST['submitLogin'])) {
		if(!isset($_POST['submitRegister'])) {
			if(!isset($_REQUEST['facebook'])) {
				include ROOT . $contentPathsocial . 'gpConfig.php'; // has all the css includes
				include ROOT . $contentPathsocial . 'User.php'; // has all the css includes
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
					$selectData = "select * from user where email='".$gpUserProfile['email']."'";
					$exquery = mysqli_query($conn, $selectData);
					$count = mysqli_num_rows($exquery);
					$Rquery = mysqli_fetch_assoc($exquery);
					if($count == 0) {
						$sql1="INSERT INTO user(email,active,login_type) VALUES ('$gpUserProfile[email]', 'Active', 'google')";
						mysqli_query($conn,$sql1);
					}
				} else {
					$authUrl = $gClient->createAuthUrl();
					$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><i class="fa fa-google" aria-hidden="true"></i> <span>Sign in with Google</span></a>';
				}

			}
		}
	}
}
/*Login Custom */

if(isset($_POST['submitLogin'])) {
	session_start();
	$selectData = "select * from user where email='".$_POST["email"]."' AND password='".md5($_POST["password"])."' AND active='Active'";
	$exquery = mysqli_query($conn, $selectData);
	$count = mysqli_num_rows($exquery);
	$Rquery = mysqli_fetch_assoc($exquery);
	if($count > 0) {
		$_SESSION['email'] = $Rquery['email'];
		header("Location: /");
	}
	else {
		header('location:'.$siteurl.'?error=login');
	}
}

/* Register */

if(isset($_POST['submitRegister'])) {
	session_start();
	$selectData = "select * from user where email='".$_POST["email"]."'";
	$exquery = mysqli_query($conn, $selectData);
	$count = mysqli_num_rows($exquery);
	$Rquery = mysqli_fetch_assoc($exquery);
	if($count > 0) {
		//echo "<script>alert('Already register');</script>";
		header('location:'.$siteurl.'?error=registeral');
	}
	else {
		$sql1="INSERT INTO user(email,password,login_type) VALUES ('$_POST[email]','".md5($_POST['password'])."', 'custom')";
		mysqli_query($conn,$sql1);
		echo "<script>alert('We have sent activation link on your mail id');</script>";
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?isActive=Yes&id=" . base64_encode($_POST["email"]);
		$toEmail = $_POST["email"];
		$subject = "User Registration Activation Email";
		$content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
		// SendGrid Initialization
		
		$apiKey = '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';
		$sendgridId = new \SendGrid($apiKey);
		//Student Notification Email - Login Details
		  $to = new SendGrid\Email('test', $toEmail);
		  $from = new SendGrid\Email('CryptoKlout', 'support@cryptoklout.com');
		  $subject = 'User Registration Activation Email';
		  $email_body = $content;
		  $htmlWrapper = "<html><body>$email_body</body></html>";
		  $content = new SendGrid\Content('text/html', $htmlWrapper);
		  $mail = new SendGrid\Mail($from, $subject, $to, $content);
		  $responseSendGrid = $sendgridId->client->mail()->send()->post($mail);
		  header('location:'.$siteurl.'?success=activation');
	}
}

/* Forgot Passwrod */ 

if(isset($_POST['submitForgot']) && $_POST["email"] != "") {
	//session_start();
	$selectData = "select * from user where email='".$_POST["email"]."' AND active='Active'";
	$qry = mysqli_query($conn, $selectData);
	$count = mysqli_num_rows($qry);
	$res = mysqli_fetch_assoc($qry);
	if($count > 0) {
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?forgot=Yes&id=" . base64_encode($_POST["email"]);
		$toEmail = $_POST["email"];
		$subject = "Forgot password Email";
		$content = "Click this link to change your password. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
		// SendGrid Initialization
		
		$apiKey = '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';
		$sendgridId = new \SendGrid($apiKey);
		//Student Notification Email - Login Details
		  $to = new SendGrid\Email('test', $_POST["email"]);
		  $from = new SendGrid\Email('CryptoKlout', 'support@cryptoklout.com');
		  $subject = 'Forgot password Email';
		  $email_body = $content;
		  $htmlWrapper = "<html><body>$email_body</body></html>";
		  $content = new SendGrid\Content('text/html', $htmlWrapper);
		  $mail = new SendGrid\Mail($from, $subject, $to, $content);
		  $responseSendGrid = $sendgridId->client->mail()->send()->post($mail);		  
		  header('location:'.$siteurl.'?success=fmailsent');
	} else {
		header('location:'.$siteurl.'?error=forgot');
	}
}


if(isset($_REQUEST['isActive']) && $_REQUEST['isActive']=='Yes' && isset($_REQUEST['id'])) {
	$email = base64_decode($_REQUEST['id']);
	$sql1="UPDATE user SET active='Active' WHERE email='$email' AND active='DeActive'";
	$res = mysqli_query($conn,$sql1);
}



if(isset($_POST['submitChange']) && isset($_REQUEST['id'])) {
	$email = base64_decode($_REQUEST['id']);
	if($_POST['newpass'] == $_POST['changepass']) {
		$pass = md5($_POST['newpass']);
		$sql1="UPDATE user SET password='$pass' WHERE email='$email'";
		$res = mysqli_query($conn,$sql1);
		if($res) {
			header('location:'.$siteurl.'?success=password');
		}
	} else {
		header('location:'.$siteurl.'?error=passwordnot');
	}
}


/* Twitter */
include ROOT . $contentPathsocial . "twitter/twitteroauth.php";

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
		}else{
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

				$user_data = $connection->get('account/verify_credentials'); 
				$result = '<h1>Twiiter Profile Details </h1>';
				$result .= '<img src="'.$user_data['profile_image_url'].'">';
				$result .= '<br/>Twiiter ID : ' . $user_data['id'];
				$result .= '<br/>Name : ' . $user_data['name'];
				$result .= '<br/>Twiiter Handle : ' . $user_data['screen_name'];
				$result .= '<br/>Follower : ' . $user_data['followers_count'];
				$result .= '<br/>Follows : ' . $user_data['friends_count'];
				$result .= '<br/>Logout from <a href="logout.php?logout">Twiiter</a>';
               // echo '<div>'.$result.'</div>';
                $selectData = "select * from user where email='".$user_data['id']."'";
				$exquery = mysqli_query($conn, $selectData);
				$count = mysqli_num_rows($exquery);
				$Rquery = mysqli_fetch_assoc($exquery);
				if($count == 0) {
					$sql1="INSERT INTO user(email,active,login_type) VALUES ('$user_data[id]', 'Active', 'twitter')";
					mysqli_query($conn,$sql1);
				}
                $_SESSION['fname'] = $user_data['name'];			
			}else{
			       die("error, try again later!");
			}
			
	}else{
		//Display login button
		$twitter =  '<a href="index.php?request=twitter"><i class="fa fa-twitter" aria-hidden="true"></i> <span>Login with Twitter</span></a>';
	}
?> 


 <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top"><a href="/" class="navbar-brand">CryptoKlout</a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span></span><span></span><span></span></button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto align-items-start align-items-lg-center" style="margin-right:10px;">
            <li class="nav-item"><a href="/pages/trends/main.php" class="nav-link">Trends</a></li>
            <li class="nav-item"><a href="/pages/ranks/sort.php" class="nav-link">Ranks</a></li>
          </ul>
          <div class="navbar-text">               
            <?php if(!empty($_SESSION['email'])) { ?>
				Welcome, <?php echo $_SESSION['email']; ?> <a href="<?php echo $siteurl; ?>logout.php" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Logout</a>
			<?php } else if(!empty($_SESSION['fname'])) { ?> 
				Welcome, <?php echo $_SESSION['fname']; ?> <a href="<?php echo $siteurl; ?>logout.php" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Logout</a>
			<?php } else { ?>
				<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Login</a>
			<?php } ?>
          </div>
        </div>
      </nav>
    </header>
    <!-- Modal-->
    <div id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Sign In</h5>            
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="signupform" action="#" method="post">
              <!--<div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" placeholder="Full Name" id="fullname">
              </div>-->
				<?php
				if(isset($_REQUEST['error']) && $_REQUEST['error'] == 'login') {
					echo "<div class='alert alert-danger text-center'>Invalid login.</div>";
				}
				?>
				<?php
				if(isset($_REQUEST['error']) && $_REQUEST['error'] == 'registeral') {
					echo "<div class='alert alert-info text-center'>Already registered.</div>";
				}
				?>
				<?php
				if(isset($_REQUEST['success']) && $_REQUEST['success'] == 'activation') {
					echo "<div class='alert alert-success text-center'>We have sent an activation link on your email.</div>";
				}
				?>
              <div class="form-group">
                <label for="username">Email Address</label>
                <input type="email" name="email" required placeholder="Enter your email">
              </div>
              <div class="form-group">
                <label for="email">password</label>
                <input type="password" name="password" required placeholder="Enter your password">
              </div>
	      
               <div class="form-group">
				   <div class="text-center">
						<button type="submit" name="submitLogin" class="submit btn btn-primary btn-shadow btn-gradient">Sign In</button>
					</div>
			 </div>
			 <hr />
			 <p class="text-center"><b>OR</b></p>
			 <div class="form-group facebook-sign">
              	<fb:login-button class="fbloginbtn"  data-width="1000" size="xlarge"  scope="public_profile,email" onlogin="checkLoginState();">Sign in with Facebook</fb:login-button>
              	<a href="#" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i> <span>Sign in with Facebook</span> </a>
          </div>
				<div class="form-group google-sign">
				   <?php echo $output; ?> 
              </div>
              <div class="form-group twitter-sign">
				  <?php echo $twitter; ?>
				  </div>
				  <hr />
				   <p class="pull-left">Don't have an account? click <a href="javascript:void(0);" id="registerModel">here</a>.</p>
				   <p class="text-right pull-right">Forgot Password ? click <a href="javascript:void(0);" id="forgotModel">here</a>.</p>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Register-->
    <div id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Sign Up</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="signupform" action="#" method="post">
              <div class="form-group">
                <label for="username">Email Address</label>
                <input type="email" name="email" required placeholder="Enter your email">
              </div>
              <div class="form-group">
                <label for="email">password</label>
                <input type="password" name="password" required placeholder="Enter your password">
              </div>
              <div class="form-group">
				<div class="text-center">
					<button type="submit" name="submitRegister" class="submit btn btn-primary btn-shadow btn-gradient">Sign Up</button>
                </div>
                <hr>
                <p class="pull-left">Already A Member? click <a href="javascript:void(0);" id="loginModel">here</a>.</p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Forgot Password-->
    <div id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Forgot Password</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="signupform" action="#" method="post">
				<?php
				if(isset($_REQUEST['error']) && $_REQUEST['error'] == 'forgot') {
					echo "<div class='alert alert-danger text-center'>Email Address Does Not Exist.</div>";
				}
				?>
				<?php
				if(isset($_REQUEST['success']) && $_REQUEST['success'] == 'fmailsent') {
					echo "<div class='alert alert-success text-center'>We have sent a forgot password link on your email.</div>";
				}
				?>
              <div class="form-group">
                <label for="username">Email Address</label>
                <input type="email" name="email" required placeholder="Enter email">
                <span class="help-inline text-danger" id="email_error">
                 </span>
              </div>
              <div class="form-group">
				<div class="text-center">
					<button type="submit" name="submitForgot" class="submit btn btn-primary btn-shadow btn-gradient">Submit</button>
				</div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Change Password-->
    <div id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Change Password</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="signupform" action="#" method="post">
				<?php
				if(isset($_REQUEST['success']) && $_REQUEST['success'] == 'password') {
					echo "<div class='alert alert-success text-center'>Password changed successfully.</div>";
				}
				?>
				<?php
				if(isset($_REQUEST['error']) && $_REQUEST['error'] == 'passwordnot') {
					echo "<div class='alert alert-danger text-center'>Password doesn't match.</div>";
				}
				?>
              <div class="form-group">
				 <input type="hidden" value="<?php echo $_REQUEST['id']; ?>" name="emailAddress"> 
                <label for="username">New Password</label>
                <input type="password" name="newpass" required placeholder="Enter new password">
              </div>
              <div class="form-group">
                <label for="username">Confirm Password</label>
                <input type="password" name="changepass" required placeholder="Enter confirm password">
              </div>
              <div class="form-group">
				  <div class="text-center">
					<button type="submit" name="submitChange" class="submit btn btn-primary btn-shadow btn-gradient">Submit</button>
				</div>	
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    


