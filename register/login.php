<?php
  require_once('../nav.php');
?>
<body>
<div class="container">
<form action="../register/login_helper.php" method="post">
 <div class='form-group'>
  <label for="inputusername"> Username:</label>
  <input type ="text" class="form-control" id="username" name="inputUsername">
 </div>

 <div class='form-group'>
  <label for="pwd"> Password:</label>
  <input type ="password" class="form-control" id="pwd" name="inputPassword">
 </div>
 <input type="submit" class="btn btn-default">
</form>
<a href='../register/register.php'>Click here to register an account<a>
<br>
<br>
<?php
  require_once('../error_and_success.php');
?>
</div>
</body>
