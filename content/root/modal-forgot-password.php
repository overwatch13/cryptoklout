<!-- Modal Forgot Password-->
<div id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-popup">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Forgot Password</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form class="form-style" action="#" method="post">

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
