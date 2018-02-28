
 <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top"><a href="/" class="navbar-brand">CryptoKlout</a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span></span><span></span><span></span></button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto align-items-start align-items-lg-center" style="margin-right:10px;">
            <li class="nav-item"><a href="/pages/trends/main.php" class="nav-link">Trends</a></li>
            <li class="nav-item"><a href="/pages/ranks/sort.php" class="nav-link">Ranks</a></li>

            <?php if(isset($_SESSION) && isset($_SESSION['email'])){ ?>
              <!-- if the user is logged in than offer them ability to make a new prediction. -->
              <li class="nav-item"><a href="/predictor/<?php echo $_SESSION['userId']; ?>" class="nav-link">Profile</a></li>
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
              <a href="#" data-toggle="modal" data-target="#modal-signin" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Login</a>
            <?php } ?>
            </li>

          </ul>
        </div>
      </nav>
    </header>

    <!-- login modal content -->
    <?php include ROOT . "/content/root/modal-login.php"; ?>
    <!-- register modal content -->
    <?php include ROOT . "/content/root/modal-register.php"; ?>
    <!-- register modal content -->
    <?php include ROOT . "/content/root/modal-forgot-password.php"; ?>
    <!-- register modal content -->
    <?php include ROOT . "/content/root/modal-change-password.php"; ?>
