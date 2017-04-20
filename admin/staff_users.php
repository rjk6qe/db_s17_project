<?php
  require_once('../nav.php'); 
  require_once('../login_required.php');
  require_once('../admin_only.php');
  require_once('../db_conn.php');
?>

<body data-gr-c-s-loaded="true">
  <div class="container"> <!-- container -->
    <div class="jumbotron">
      <h1>Change Admin</h1>
    </div>
  
    <div class="row"> <!-- row -->
    <div class="col-lg-4"> <!-- col -->
        <h2>Grant Admin Permission</h2>
       
          <form action="grant_admin_helper.php" method="post">
                <?php 
                session_start();
      $db =DbUtil::create();
      $stmt = $db->prepare("SELECT username FROM Constituent WHERE is_active='1' AND is_admin='0' AND username != ?");
      
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
        echo "<label>There are no regular users to give admin access";   
      } else{
        while($stmt->fetch()){
          echo "<div class='checkbox'><label><input type='checkbox' name='grant_user[]' value='$username'>$username</label>";
        };
      }
      
    ?>
    </br>
    </br>
      <input class='btn btn-primary btn-sm' type='submit' value='Grant Access'>

          </form>
  </div> <!-- col -->
      <div class="col-lg-4"> <!-- col -->
        <h2>Remove Admin Permission</h2>
       
          <form action="remove_admin_helper.php" method="post">
                <?php 
                session_start();
      $db =DbUtil::create();
      $stmt = $db->prepare("SELECT username FROM Constituent WHERE is_active='1' AND is_admin='1' AND username != ?");
      
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
      if($stmt->num_rows == 0){
        echo "<label>There are no other admin users</label>";
      } else{
        while($stmt->fetch()){
          echo "<div class='checkbox'><label><input type='checkbox' name='remove_user[]' value='$username'>$username</label>";
        };
      }
      
    ?>
    </br>
    </br>
      <input class='btn btn-primary btn-sm' type='submit' value='Remove Access'>

          </form>
  </div> <!-- col -->

  </div> <!-- row -->
  </div> <!-- container -->
</body>