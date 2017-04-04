<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Follow Your Congressperson!</title>

    <?php
								require_once('nav.php');
?>
  </head>



<body>
<nav class = "navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
<a class="navbar-brand" href="#">Registration</a>
</nav>

<form action="register_helper.php" method="post">
 <div class='form-group'>
  <label for="inputusername"> Username:</label>
  <input type ="text" class="form-control" id="username" name="inputUsername">
 </div>

 <div class='form-group'>
  <label for="pwd"> Password:</label>
  <input type ="password" class="form-control" id="pwd" name="inputPassword">
 </div>

 <div class='form-group'>
  <label for="email"> Email:</label>
  <input type ="email" class="form-control" id="email" name="inputEmail">
 </div>
 <input type="submit" class="btn btn-default"> 
</form>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
