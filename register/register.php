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
								require_once('../register/nav.php');
?>
  </head>



<body>

<div class="container">

<form action="register_helper.php" method="post">
 <div class='form-group'>
  <label for="inputusername"> Username:</label>
  <input type ="text" class="form-control" id="username" name="inputUsername">
 </div>

 <div class='form-group'>
  <label for="email"> Email:</label>
  <input type ="email" class="form-control" id="email" name="inputEmail">
 </div>

 <div class='form-group'>
  <label for="pwd"> Password:</label>
  <input type ="password" class="form-control" id="pwd" name="inputPassword1">
 </div>

 <div class='form-group'>
  <label for="pwd"> Password again:</label>
  <input type ="password" class="form-control" id="pwd" name="inputPassword2">
 </div>

 <input type="submit" class="btn btn-default"> 
</form>

<br>
<a href='login.php'>Already have an account? Login here</a>

<br>
<br>
<?php
								if(isset($_SESSION['error_msg'])){
     echo "<div class='alert alert-danger'>                                                     
<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>                   
<strong>Oops!</strong> ". $_SESSION['error_msg'] ." </div>";
     unset($_SESSION['error_msg']);
								}
?>

</div>

</body>

</html>