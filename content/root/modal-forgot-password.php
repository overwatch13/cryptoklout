<!-- Modal Forgot Password-->
<div id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Forgot Password</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form id="forgot-password-form" class="form-style">
          <div class="registerResponse"></div>
          <div class="form-group">
            <label for="username">Email Address</label>
            <input id="forgot-password-input-email" type="email" name="email" required placeholder="Enter email">
          </div>
          <div class="form-group">
            <div class="text-center">
              <button id="js-submit-forgot-password-btn" class="submit btn btn-primary btn-shadow btn-gradient">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
