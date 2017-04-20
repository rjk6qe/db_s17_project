<?php
  require_once('../nav.php');
?>

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

<!--
<div class='form-groups'>
  <label> State:</label><br>
  <input list="states" name="state" class="form-control">
  <datalist id='states'>
    <?php
        require_once('../account/states.php');
        $states = getStates();
        foreach($states as $key=>$value){
          echo "<option value=$value> $key";
        }
    ?>
  </datalist>
</div>

 <div class='form-group'>
  <label for="district"> District (Leave at -1 if unknown):</label>
  <input type ="number" class="form-control" id="district" name="inputDistrict" value="-1">
 </div>
-->
 <div class='form-group'>
  <label for="pwd"> Password:</label>
  <input type ="password" class="form-control" id="pwd" name="inputPassword1" pattern = ".{8,}" required title="8 characeters minimum">
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
  require_once("../error_and_success.php");
?>
</div>
</body>
