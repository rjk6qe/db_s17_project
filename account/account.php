<?php
	require_once('../nav.php');
	require_once('../login_required.php');
	require_once('states.php');
?>


<body data-gr-c-s-loaded="true">
    <div class="container">
      <div class="jumbotron">
        <h1>Account Settings</h1>
      </div>
<?php
	require_once('../error_and_success.php');
?>
      <div class="col-lg-6">
        <div class="row">
	<h2>Your Senators!</h2>
          <?php 
		require_once('../db_conn.php');
		$db =DbUtil::create();
		session_start();
		$username = $_SESSION['user'];
		$user_email = $_SESSION['user_email'];
		$stmt = $db->prepare("SELECT state, district FROM Constituent WHERE username = ? LIMIT 1");
		$stmt->bind_param('s', $username);

		if(!$stmt){
		  echo $db->error;
		}

		if(!$stmt->execute()){
		  echo $stmt->error;
		}
		$stmt -> bind_result($state, $district);
		$stmt -> store_result();
		$stmt->fetch();

		$statename = getStateName(strtoupper($state));

		if($state == NULL){
			echo "<p> We don't know what state you live in! Start following your senators and add your state! </p>";			  
		}else{
			echo "<p> Our records indicate you live in {$statename}! Update this information below! </p>";
		}
		$states = getStates();
		echo "Enter State: <form action='change_state.php' method='post'><input list='states' name='state'><datalist id='states'>";
    		foreach($states as $cstate){
			echo "<option value='{$cstate}'>";
		}
		echo "</datalist> <input class='btn btn-primary btn-sm' type='submit' value='Change State'></form>";
		?>
		<!--<p><form action="statechange.php" method="post">-->
		<!--   <div class="input-group" id="select-input-group">-->
		<!--	<select id = "selectState" class="selectpicker">-->
			<?php
		//	 $stmtState = $db->prepare("SELECT DISTINCT state FROM Congressperson");

	        //         if(!$stmtState){
                //        	echo $db->error;
               //	 }
                //	 if(!$stmtState->execute()){
                //         	echo $stmt->error;
                //   	 }
		
               // 	$stmtState -> store_result();
                //	$stmtState->bind_result($stateList);
                //	while($stmtState->fetch()){
		//		echo "<option name='option' value='$stateList'> $stateList </option>";
		//	};
			?>
		<!--	</select>-->
		<!--	<a class="btn-sm" role="submit"> Change State!</a>-->
		<!--  </div>-->
		 <!-- </form>-->
		<!--</p>-->
	</div>
	<div class = "row">
          <h2>General Settings</h2>       
          <p><form action="change_username.php" method='post'>
		<input type= 'text' name='username' placeholder="<?php echo $username ?>" >
		<input class = 'btn btn-primary btn-sm' type='submit' value='Change Username'>	
	     </form></p>
      	  <p><form action="change_email.php" method='post'>
                <input type= 'email' name='email' placeholder = "<?php echo $user_email ?>" >
                <input class = 'btn btn-primary btn-sm' type='submit' value='Change Email'>
             </form></p>
	  <p>Change your password!</p>
          <p><a class="btn btn-primary btn-sm" href="change_password.php" role="button">Change Password </a></p>
	</div>

</div>
	<div class="col-lg-6">
        <h2>Your Representatives!</h2>
          <?php
		if($district == -1){
			?> <p> We don't know what district you live in! Start following your representatives and add your district! </p>
                           <!--<p><a class="btn btn-primary" href="#" role="button">Add your home district! »</a></p>-->
			   <p>Enter District Number:</p>
			   <form action='change_district.php' method='post'>
			   <input name='district'> <input class="btn btn-primary" type='submit' value='Change District'>
			   </form>
		 <?php
		}else{
			?> <p> Our records indicate you live in district <?php echo "{$district}"; ?>! Update this information below! </p>
                           <!--<p><a class="btn btn-primary" href"#" role="button">Update your home district! »</a></p>-->
			   <p>Enter District Number:</p>
			   <form action='change_district.php' method='post'>
			   <input name='district'> <input class="btn btn-primary btn-sm" type='submit' value='Change District'>
			   </form>
		<?php
		}
	  ?>
<iframe width="425" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
src="https://www.govtrack.us/congress/members/embed/mapframe?&bounds=-128.741,54.306,-65.459,14.417"></iframe>

        </div>
</div>


      <!-- Site footer -->
      <footer class="footer">
        
      </footer>

    </div> <!-- /container -->


</body>

</html>
