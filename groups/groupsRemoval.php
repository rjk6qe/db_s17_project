<?php
  require_once('../login_required.php');
  require_once('../nav.php');
?>

<body data-gr-c-s-loaded="true">
    <div class="container">
      <div class="jumbotron">
        <h1>Leave Group</h1>
      </div>
      <!-- Example row of columns -->
      <div class="col-lg-6">
        <div class="row">
	<h2>Your current groups!</h2>
       
<p><form action="groupsRemoval_helper.php" method="post">
	<!--<input list = 'groups' name='group' autocomplete="off">
	<datalist id = 'groups'>
	-->   
	<select class = "form-control" id = "groups" name = "group">
		<?php 
		require_once('../db_conn.php');

//echo "<select id="groups" name="groups">";
		$db =DbUtil::create();
		session_start();
		$username = $_SESSION['user'];
		$stmt = $db->prepare("SELECT group_name FROM InterestedIn WHERE username = ?");
		if(!$stmt){
		  echo $db->error;
		}

$stmt->bind_param("s", $username);
		
		if(!$stmt->execute()){
		  echo $stmt->error;
		}
		$stmt -> bind_result($group_name);
		$stmt -> store_result();

		while($stmt->fetch()){
		  echo '<option value="' . htmlentities($group_name) . '">' . htmlentities($group_name);
		};
	
		echo "</datalist> <input class='btn btn-primary btn-sm' type='submit' value='Leave Group'></form>";
	
		echo "</select>";
?>	
</div>



 <div class = "row">
        <h2> Current Group Descriptions </h2>
        <table class="table">
                <tr> <th>Group Name</th>  <th>Topic</th> </tr>
                <?php

                $stmt = $db->prepare("SELECT group_name, topic FROM InterestGroup NATURAL JOIN InterestedIn WHERE username = ?");

                if(!$stmt){
                  echo $db->error;
                }
$stmt->bind_param("s", $username);
                if(!$stmt->execute()){
                  echo $stmt->error;
                }
                $stmt -> bind_result($group_name, $topic);
                $stmt -> store_result();
                while($stmt->fetch()){
                        echo "<tr> <td> ".htmlentities($group_name)." </td> <td> $topic </td> </tr>";
                };
                ?>
        </table>
        <div>
	
<a role="button" class="btn btn-primary center-block" href="groups.php">Back</a>

</div>
</div> <!-- /container -->
</body>

