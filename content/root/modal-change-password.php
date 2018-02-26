<!-- Modal Change Password-->
<div id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Change Password</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form class="form-style" action="#" method="post">
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
