<?php
session_start();
require_once('header.php');
echo '<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../main/main.php">Follow Your Congressperson</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">';
if(isset($_SESSION['logged_in'])){
    if($_SESSION['logged_in'] == true){
      echo 
	'<li><a href="../yourcongresspeople/congresspeople_main.php">Congresspeople</a></li>
                    <li><a href="../bills/bills.php">Bills</a></li>
                    <li><a href="../groups/groups.php">Your Groups</a></li>
	<li><a href="../account/account.php">User Info</a></li>';
      if($_SESSION['is_admin'] == true){
	echo '<li><a href="../admin/admin.php">Admin</a></li>';
      }
      echo '<li><a href="../register/logout_helper.php">Logout</a></li>';
    }

  }

echo '</ul>
            </div><!--/.nav-collapse -->
        </div>
        </nav>';

?>
