<!-- Modal Change Password-->
<div id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Change Password</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form id="changePasswordModalFormId" class="form-style">
          <div class="registerResponse"></div>
          <div class="form-group">
            <input id="changePasswordModalEmail" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
            <input id="changePasswordModalHashVerificationToken" type="hidden" value="<?php echo $_REQUEST['hashVerificationToken']; ?>">
            <label for="password1">New Password</label>
            <input id="changePasswordModalPassword1" type="password" name="password1" placeholder="Enter new password">
          </div>
          <div class="form-group">
            <label for="password2">Confirm Password</label>
            <input id="changePasswordModalPassword2" type="password" name="password2" placeholder="Enter confirm password">
          </div>
          <div class="form-group">
          <div class="text-center">
            <button id="changePasswordModalSubmitBtn" class="submit btn btn-primary btn-shadow btn-gradient">Submit</button>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
