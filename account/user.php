<?php
require_once('../db_conn.php');
require_once('../login_required.php');
require_once('../nav.php');
require_once('states.php');
session_start();
$username = $_SESSION['user'];
$db =DbUtil::create();
// find user state and district
$stmt = $db->prepare("SELECT email, state, district FROM Constituent WHERE username = '{$username}' LIMIT 1");

if(!$stmt){
  echo $db->error;
}

if(!$stmt->execute()){
  echo $stmt->error;
}
$stmt -> bind_result($email, $state, $dist);
$stmt -> store_result();
$stmt->fetch();

$statename = getStateName(strtoupper($state));
?>

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

    <title>User Information</title>
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


<body data-gr-c-s-loaded="true">

    <div class="container">

      <div class="masthead">

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Your Information</h1>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
	<?php
	echo "<p>Your current state is set to {$statename}.</p>";
	$states = getStates();
	echo "Select State: <form action='change_state.php' method='post'><input list='states' name='state'><datalist style='overflow: auto' id='states'>";
    	foreach($states as $state){
		echo "<option value='{$state}'>";
	}
	echo "</datalist><input type='submit' value='Change State'></form>";	

	echo "<p> Your current district is set to {$dist}.</p>";
	echo "Enter District Number (if unknown use <a href='http://www.house.gov/representatives/find/'>this</a> site): <form action='change_district.php' method='post'><input name='district'><input type='submit' value='Change District'></form>";

	?>
        </div>
      <!-- Site footer -->
      <footer class="footer">

      </footer>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
