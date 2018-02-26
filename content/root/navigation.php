<?php
include ROOT . "jobs/loginAuth.php";
include ROOT . "content/phpviews/navigation-view-helper.php";
?>


 <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top"><a href="/" class="navbar-brand">CryptoKlout</a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span></span><span></span><span></span></button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto align-items-start align-items-lg-center" style="margin-right:10px;">
            <?php if($navigationConfirmationMessageOn){ echo $navigationMessage; } ?>
            <li class="nav-item"><a href="/pages/trends/main.php" class="nav-link">Trends</a></li>
            <li class="nav-item"><a href="/pages/ranks/sort.php" class="nav-link">Ranks</a></li>

            <?php if(isset($_SESSION) && isset($_SESSION['email'])){ ?>
              <!-- if the user is logged in than offer them ability to make a new prediction. -->
              <li class="nav-item"><a href="/predictor/<?php echo $_SESSION['id']; ?>" class="nav-link">Profile</a></li>
               <li class="nav-item"><a href="/pages/predictions/prediction-choices.php" class="nav-link">New Prediction</a></li>
            <?php } ?>

            <li class="nav-item" style="padding: .5rem 1rem;">
              <?php // for testing
              // echo '<pre style="font-size:11px;">';
              // print_r($_SESSION);
              // echo '</pre>';
              ?>

            <?php if(!empty($_SESSION['email'])) { ?>
              <span class='welcome-nav-msg'>Welcome, <?php echo $_SESSION['email']; ?></span> <a href="<?php echo $siteurl; ?>logout.php" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Logout</a>
            <?php } else if(!empty($_SESSION['fname'])) { ?>
              Welcome, <?php echo $_SESSION['fname']; ?> <a href="<?php echo $siteurl; ?>logout.php" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Logout</a>
            <?php } else { ?>
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Login</a>
            <?php } ?>
            </li>

          </ul>
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
				   <?php echo $returnData; ?>
              </div>
              <div class="form-group twitter-sign">
				  <?php echo $returnTData; ?>
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
