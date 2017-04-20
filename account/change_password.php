<?php
  require_once('../nav.php');
  require_once('../login_required.php');
?>
<br><br>
<body>
<div class="container">
<form action="change_password_helper.php" method="post">
 <div class='form-group'>
  <label for="pwd"> Old Password:</label>
  <input type ="password" class="form-control" id="pwd" name="old_password">
 </div>
 <div class='form-group'>
  <label for="pwd">New Password:</label>
  <input type ="password" class="form-control" id="pwd" name="new_password1" pattern=".{8,}" required title = "8 characters minimum" > 
 </div>
 <div class='form-group'>
  <label for="pwd">New Password again:</label>
  <input type ="password" class="form-control" id="pwd" name="new_password2">
 </div>
 <input type="submit" class="btn btn-default"> 
</form>
<br>
<a href='login.php'>Already have an account? Login here</a>
<br>
<br>
<?php
  require_once('../error_and_success.php');
?>
</div>
</body>
</html>
