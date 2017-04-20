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
								require_once('../nav.php');
require_once('../login_required.php');
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
          <p><a class="btn btn-primary" href="../groups/groups.php" role="button">View Groups »</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Your Congresspeople</h2>
          <p>See what committees your representatives serve on and how they vote. </p>
          <p><a class="btn btn-primary" href="../yourcongresspeople/congresspeople.php" role="button">View Representatives »</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Your Account</h2>
          <p>Change information like your password, senator, or representative here!</p>
          <p><a class="btn btn-primary" href="../account/account.php" role="button">View details »</a></p>
        </div>
	  <?php
	  if($_SESSION['is_admin']){
        echo '<div class="col-lg-4">
          <h2>Admin</h2>
          <p>Change user privileges and export data!</p>
          <p><a class="btn btn-primary" href="../admin/admin.php" role="button">View details »</a></p>';
        }
?>
      </div>

      <!-- Site footer -->
      <footer class="footer">
        
      </footer>

    </div> <!-- /container -->
</body>

<br><br><br>

</html>
