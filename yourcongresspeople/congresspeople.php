<?php
require_once('../db_conn.php');
require_once('../login_required.php');
require_once('../nav.php');
require_once('states.php');
session_start();
$username = $_SESSION['user'];
$db =DbUtil::create();
// find user state and district
$stmt = $db->prepare("SELECT member_id FROM Have WHERE username = ?");

$stmt->bind_param('s', $username);

if(!$stmt){
  echo $db->error;
}

if(!$stmt->execute()){
  echo $stmt->error;
}
$stmt -> bind_result($member_id);
$stmt -> store_result();
$members = array();
while ($stmt->fetch()) {
	//echo $member_id;
	$members[] = $member_id;
}

$output = "<table><tr><th style='padding: 8px; border: 1px solid #dddddd;'>Type</th><th style='padding: 8px; border: 1px solid #dddddd;'>Name</th><th style='padding: 8px; border: 1px solid #dddddd;'>Party</th>";
foreach($members as $mid){
     $stmt = $db->prepare("SELECT type, first_name, last_name, party FROM Congressperson WHERE member_id='{$mid}'");
     if(!$stmt){
           echo $db->error;
     }
     if(!$stmt->execute()){
           echo $stmt->error;
     }
     $stmt -> bind_result($type, $first_name, $last_name, $party);
     $stmt -> store_result();
     $stmt -> fetch();
     $type_name = '';
     if($type=='senate'){$type_name = 'Senate';}
     else{$type_name = 'House';}
     $output = $output."<tr><td style='padding: 8px; border: 1px solid #dddddd;'>{$type_name}</td><td style='padding: 8px; border: 1px solid #dddddd;'><a href='view_congressperson.php?id={$mid}'>{$first_name} {$last_name}</a></td><td style='padding: 8px; border: 1px solid #dddddd;'>{$party}</td></tr>";
     $stmt -> close();
}

$output = $output."</table>";

$stmt = $db->prepare("SELECT state, district FROM Constituent WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($state, $dist);

$stmt->store_result();
$stmt->fetch();

$statename = getStateName(strtoupper($state));
?>

<rbody data-gr-c-s-loaded="true">

    <div class="container">

      <div class="masthead">

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Your Congresspeople</h1>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-8">
          <h2>Congresspeople</h2>
	<p>Here is a list of your congresspeople based on your state and district</p>
	<?php
	if($statename == null){
		echo "<p> We have no information about your state ";
	}
	else{
		echo "<p>Your state is {$statename} ";
	}
	if($dist == -1){
		echo "and we have no information about your district. Go to User Info to set your info.</p>";
	}else{
		echo "and your district is {$dist}.</p>";
	}
	echo $output;
	?>
        </div>
<br>

       </div>
	<br><br>
    </div> <!-- /container -->

</body>
