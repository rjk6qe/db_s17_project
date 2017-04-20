<?php
require_once('../db_conn.php');
require_once('../login_required.php');
require_once('../nav.php');
require_once('states.php');
session_start();
$username = $_SESSION['user'];
$db =DbUtil::create();
// find user state and district
$stmt = $db->prepare("SELECT state, district FROM Constituent WHERE username = '{$username}' LIMIT 1");

if(!$stmt){
  echo $db->error;
}

if(!$stmt->execute()){
  echo $stmt->error;
}
$stmt -> bind_result($state, $dist);
$stmt -> store_result();
$stmt->fetch();

$stmt = $db->prepare("SELECT member_id, first_name, last_name, party FROM Congressperson WHERE type='senate' AND state = '{$state}'");
if(!$stmt){
  echo $db->error;
}

if(!$stmt->execute()){
  echo $stmt->error;
}
$stmt -> bind_result($senator_id, $senator_first_name, $senator_last_name, $senator_party);
$stmt -> store_result();

$output = "<table><tr><th style='padding: 8px; border: 1px solid #dddddd;'>Type</th><th style='padding: 8px; border: 1px solid #dddddd;'>Name</th><th style='padding: 8px; border: 1px solid #dddddd;'>Party</th>";
while ($stmt->fetch()) {
	$output = $output."<tr><td style='padding: 8px; border: 1px solid #dddddd;'>Senate</td><td style='padding: 8px; border: 1px solid #dddddd;'><a href='view_congressperson.php?id={$senator_id}'>{$senator_first_name} {$senator_last_name}</a></td><td style='padding: 8px; border: 1px solid #dddddd;'>{$senator_party}</td></tr>";
}
$stmt -> close();

$stmt = $db->prepare("SELECT member_id, first_name, last_name, party FROM Congressperson WHERE type='house' AND state = '{$state}' AND district = {$dist}");
if(!$stmt){
  echo $db->error;
}

if(!$stmt->execute()){
  echo $stmt->error;
}
$stmt -> bind_result($house_id, $house_first_name, $house_last_name, $house_party);
$stmt -> store_result();
//$num_of_rows = $stmt->num_rows;
while ($stmt->fetch()) {
	$output = $output."<tr><td style='padding: 8px; border: 1px solid #dddddd;'>House</td><td style='padding: 8px; border: 1px solid #dddddd;'><a href='view_congressperson.php?id={$house_id}'>{$house_first_name} {$house_last_name}</a></td><td style='padding: 8px; border: 1px solid #dddddd;'>{$house_party}</td></tr>";
}

$output = $output."</table>";
$statename = getStateName(strtoupper($state));
?>

<body data-gr-c-s-loaded="true">

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
	echo "<p>Your state is {$statename} ";
	if($dist == -1){
		echo "and we have no information about your district.</p>";
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
