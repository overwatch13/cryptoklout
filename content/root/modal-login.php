<!-- Modal-->
<div id="modal-signin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Sign In</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
          <div class="modal-body">
            <form id="user-sign-in-form-id" class="form-style">
              <div class="registerResponse"></div>
              <div class="form-group">
                <label for="username">Email Address</label>
                <input type="email" id="userLoginEmail" name="email" required placeholder="Enter your email">
              </div>
              <div class="form-group">
                <label for="email">password</label>
                <input type="password" id="userLoginPassword" name="password" required placeholder="Enter your password">
              </div>

            <div class="form-group">
          <div class="text-center">
            <button type="submit" id="js-login-btn" name="submitLogin" class="submit btn btn-primary btn-shadow btn-gradient">Sign In</button>
              <div class="clear" style="margin-top:20px;">
                <p class="pull-left">Don't have an account? click <a href="javascript:void(0);" id="registerModel">here</a>.</p>
                <p class="text-right pull-right">Forgot Password ? click <a href="javascript:void(0);" id="forgotModel">here</a>.</p>
              </div>
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
        </form>
      </div>
    </div>
  </div>
</div>