<?php
	require_once('../nav.php'); 
  require_once('../login_required.php');
  require_once('../admin_only.php');
  require_once('../db_conn.php');
?>
<body data-gr-c-s-loaded="true">
  <div class="container"> <!-- container -->
    <div class="jumbotron">
      <h1>Delete User Accounts</h1>
    </div>
  
    <div class="row"> <!-- row -->
    <div class="col-lg-4"> <!-- col -->
        <h2>Delete Users</h2>
       
          <form action="deactivate_users_helper.php" method="post">
                <?php 
                session_start();
      $db =DbUtil::create();
      $stmt = $db->prepare("SELECT username FROM Constituent WHERE username != ?");
      
      if(!$stmt){
        echo $db->error;
      }

      $stmt->bind_param("s", $username);

      $username = $_SESSION['user'];

      if(!$stmt->execute()){
        echo $stmt->error;
      }

      $stmt -> bind_result($username);
      $stmt -> store_result();
      if($stmt->num_rows == 0) {
        echo "<label>There are no activated users";   
      } else{
        while($stmt->fetch()){
          echo "<div class='checkbox'><label><input type='checkbox' name='deactivate_user[]' value='$username'>$username</label>";
        };
      }
      
    ?>
    </br>
    </br>
      <input class='btn btn-primary btn-sm' type='submit' value='Deactivate Users'>

          </form>
  </div> <!-- col -->
      <!-- <div class="col-lg-4">
        <h2>Activate Users</h2>
       
          <form action="activate_users_helper.php" method="post">
                <?php 

      //           session_start();
      // $db =DbUtil::create();
      // $stmt = $db->prepare("SELECT username FROM Constituent WHERE is_active='0' AND username != ?");
      
      // if(!$stmt){
      //   echo $db->error;
      // }

      // $stmt->bind_param("s", $username);

      // $username = $_SESSION['user'];

      // if(!$stmt->execute()){
      //   echo $stmt->error;
      // }

      // $stmt -> bind_result($username);
      // $stmt -> store_result();
      // if($stmt->num_rows == 0){
      //   echo "<label>There are no deactivated users</label>";
      // } else{
      //   while($stmt->fetch()){
      //     echo "<div class='checkbox'><label><input type='checkbox' name='activate_user[]' value='$username'>$username</label>";
      //   };
      // }
      
    ?>
    </br>
    </br>
      <input class='btn btn-primary btn-sm' type='submit' value='Activate Users'>
 -->
          </form>
  </div> <!-- col -->

  </div> <!-- row -->
  </div> <!-- container -->
</body>