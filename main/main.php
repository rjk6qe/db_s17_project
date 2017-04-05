<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Follow Your Congressperson!</title>
<?php
								require_once('../register/nav.php');
require_once('../register/login_required.php');
?>
							       
  </head>


<body data-gr-c-s-loaded="true">

    <div class="container">

      <!-- Jumbotron -->
      <div class="jumbotron">
  <h1>Welcome Back, <?php echo $_SESSION['user']; ?>!</h1>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>Groups</h2>
          <p>Follow bills and topics that are most important to you! Discuss how your representatives are supporting their campaign promises and protecting your interests.  </p>
          <p><a class="btn btn-primary" href="groups.html" role="button">View Groups »</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Your Congresspeople</h2>
          <p>See what committees your representatives serve on and how they vote. </p>
          <p><a class="btn btn-primary" href="#" role="button">View Representatives »</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Your Account</h2>
          <p>Change information like your password, senator, or representative here!</p>
          <p><a class="btn btn-primary" href="../account/account.php" role="button">View details »</a></p>
        </div>
      </div>

      <!-- Site footer -->
      <footer class="footer">
        
      </footer>

    </div> <!-- /container -->
</body>

</html>
