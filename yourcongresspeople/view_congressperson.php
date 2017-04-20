<?php
require_once('../db_conn.php');
require_once('../login_required.php');
require_once('../nav.php');
require_once('states.php');
session_start();
$username = $_SESSION['user'];
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
$db =DbUtil::create();
$stmt = $db->prepare("SELECT first_name, last_name, district, state, party, type FROM Congressperson WHERE member_id = '{$id}'");
if(!$stmt){ echo $db->error;}
if(!$stmt->execute()){ echo $stmt->error;}
$stmt -> bind_result($fname, $lname, $district, $state, $party, $type);
$stmt -> store_result();
$stmt -> fetch();
?>

<body data-gr-c-s-loaded="true">

    <div class="container">

      <div class="masthead">

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Your Congresspeople</h1>
      </div>
      <div>
	<?php
	// General Info
	echo "<h1>{$fname} {$lname}</h1>";
	if($type == 'senate'){echo "<h3>Senate Member</h3>";}
	else{echo "<h3>House Member</h3>";}
	if($district != -1){
		echo "<h3>District: {$district}</h3>";
	}
	$statename = getStateName(strtoupper($state));
	echo "<h3>State: {$statename}</h3>";
	if($party == 'R'){$partyname = 'Republican';}
	else if($party == 'D'){$partyname = 'Democrat';}
	else{$partyname = 'Independent';}
	echo "<h3>Party: {$partyname}</h3><br><br>";
	$stmt -> close();

	// serves on
        $stmt = $db->prepare("SELECT c.committee_name as committee_name, c.committee_id as committee_id from ServesOn s left join Committee c on s.committee_id = c.committee_id WHERE s.member_id = '{$id}'");
     	if(!$stmt){ echo $db->error;}
     	if(!$stmt->execute()){ echo $stmt->error;}
     	$stmt -> bind_result($committee_name, $committee_id);
     	$stmt -> store_result();
     	echo "<h4>Congressperson {$fname} {$lname} serves on the following committees:</h4><br>";
     	echo "<table><tr><th style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Committee Name</th></tr>";
     	$i=0;
	while ($stmt->fetch()) {
	   if($committee_name!= ''){
	     echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>{$committee_name}</td></tr>";
           } else{
             echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Congressperson {$fname} {$lname} does not serve on any committees.</td></tr>";
	   }
	   $i++;
       	}
	if($i==0){echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Congressperson {$fname} {$lname} does not serve on any committees.</td></tr>";}
        echo "</table><br><br>";
        $stmt -> close();

	// bills sponsored
        $stmt = $db->prepare("SELECT title from Bill WHERE member_id = '{$id}'");
     	if(!$stmt){ echo $db->error;}
     	if(!$stmt->execute()){ echo $stmt->error;}
     	$stmt -> bind_result($stitle);
     	$stmt -> store_result();
     	echo "<h4>Congressperson {$fname} {$lname} sponsors the following bills:</h4><br>";
     	echo "<table><tr><th style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Bill Title</th></tr>";
     	$i=0;
	while ($stmt->fetch()) {
	   if($stitle != ''){
	     echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>{$stitle}</td></tr>";
           }else{
             echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Congressperson {$fname} {$lname} does not sponsor any bills.</td></tr>";
	   }
	   $i++;
       	}
	if($i==0){echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Congressperson {$fname} {$lname} does not sponsor any bills.</td></tr>";}
        echo "</table><br><br>";
        $stmt -> close();




    	// Bills voted on
        $stmt = $db->prepare("SELECT title, bill_id FROM CongresspersonDetails WHERE member_id = '{$id}'");
     	if(!$stmt){ echo $db->error;}
     	if(!$stmt->execute()){ echo $stmt->error;}
     	$stmt -> bind_result($title, $bill_id);
     	$stmt -> store_result();
     	echo "<h4>Congressperson {$fname} {$lname} voted on the following bills:</h4><br>";
     	echo "<table><tr><th style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Bill Title</th></tr>";
	$i=0;
     	while ($stmt->fetch()) {
	   if($title != ''){
	     echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>{$title}</td></tr>";
           } else{
             echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Congressperson {$fname} {$lname} has not voted on any bills.</td></tr>";
	   }
	   $i++;
       	}
	if($i==0){echo "<tr><td style='padding: 8px; border: 1px solid #dddddd; width: 100%;'>Congressperson {$fname} {$lname} has not voted on any bills.</td></tr>";}
        echo "</table>";
        $stmt -> close();
	?>
      </div>
    </div> <!-- /container -->
<br><br><br>
</body>
