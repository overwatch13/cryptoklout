<!-- Modal Register-->
<div id="RegisterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Sign Up</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form id="registerModalForm" class="form-style">
          <div class="registerResponse"></div>
          <div class="form-group">
            <label for="username">Email Address</label>
            <input id="user-register-email-address" type="email" name="email" required placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="email">password</label>
            <input id="user-register-password" type="password" name="password" required placeholder="Enter your password">
          </div>
          <div class="form-group">
            <div class="text-center">
              <button id="js-user-register" class="submit btn btn-primary btn-shadow btn-gradient">Sign Up</button>
            </div>
            <hr>
            <p class="pull-left">Already A Member? click <a href="javascript:void(0);" id="loginModel">here</a>.</p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
