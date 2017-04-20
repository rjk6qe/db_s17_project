<?php
  require_once('../login_required.php');
  require_once('../nav.php');
?>

<body data-gr-c-s-loaded="true">
    <div class="container">
      <div class="jumbotron">
        <h1>Join Group</h1>
      </div>
      <div class="col-lg-6">
        <div class="row">
	<h2>Available Groups!</h2>
       
<p><form action="groupsExisting_helper.php" method="post">
	<select class = "form-control" id="groups" name = 'group'>   
		<?php 
		require_once('../db_conn.php');
		$db =DbUtil::create();
		session_start();
		$username = $_SESSION['user'];
		$stmt = $db->prepare("SELECT group_name FROM InterestGroup WHERE group_name NOT IN (SELECT group_name FROM InterestedIn WHERE username='{$username}')");
		
		if(!$stmt){
		  echo $db->error;
		}

		if(!$stmt->execute()){
		  echo $stmt->error;
		}
		$stmt -> bind_result($group_name);
		$stmt -> store_result();
		while($stmt->fetch()){
			echo "<option>$group_name";
		};
		echo "</datalist> <input class='btn btn-primary btn-sm' type='submit' value='Join Group'></form>";
	?>
		</select>
	</div>
	<div class = "row">
	<h2> Groups Available to join - Descriptions </h2>
	<table class="table">
		<tr> <th>Group Name</th>  <th>Topic</th> </tr>
		<?php
		$stmt = $db->prepare("SELECT group_name, topic FROM InterestGroup WHERE group_name NOT IN (SELECT group_name FROM InterestedIn WHERE username=?)");
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
	            echo "<tr> <td> $group_name </td> <td> $topic </td> </tr>";
	    };
		?>
	</table>
   <a role="button" class="btn btn-primary center-block" href="groups.php">Back</a>
</div>
    </div> <!-- /container -->
</body>
