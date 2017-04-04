<TYPE html>
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
								require_once('nav.php');
							       
							      

								?>
  
</head>



<body>

<nav class = "navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
<a class="navbar-brand" href="#">Welcome Back! Login here.</a>
</nav>

<div class="container">
<form action="login_helper.php" method="post">
 <div class='form-group'>
  <label for="inputusername"> Username:</label>
  <input type ="text" class="form-control" id="username" name="inputUsername">
 </div>

 <div class='form-group'>
  <label for="pwd"> Password:</label>
  <input type ="password" class="form-control" id="pwd" name="inputPassword">
 </div>
 <input type="submit" class="btn btn-default">
</div>
</body>
</html>
