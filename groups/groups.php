<?php
  require_once('../nav.php');
  require_once('../login_required.php');
?>

<body data-gr-c-s-loaded="true">

    <div class="container">

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>My Groups!</h1>
      </div>
	<?php
    require_once('../error_and_success.php');
	?>

	<div class = "row">
      		<p> <h2> Your Current Groups </h2> </p>
	<table class="table">
	<?php
		require_once('../db_conn.php');
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
	echo '<tr><td> <a href="view_group.php?id=' . htmlentities($group_name) .'"> ' . htmlentities($group_name). ' </a> </td> </tr>';
    };
	?>
	</table>
	</div>
	

<div class="col-lg-12">
    <div class="row">
        <div class="col-xs-4">
		<a role="button" class="btn btn-default center-block" href="groupsNew.php">Create new group</a>
        </div>
        <div class="col-xs-4">
		<a role="button" class="btn btn-default center-block" href="groupsExisting.php">Join existing group </a>
        </div>
        <div class="col-xs-4">
                <a role="button" class="btn btn-default center-block" href="groupsRemoval.php">Leave a group</a>
        </div>
    </div>
<br>
 <a role="button" class="btn btn-primary center-block" href="../main/main.php">Back</a>

</div>
</body>

