<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from Congressperson where last_name like ?") or die(mysqli_error($db))) {
		$searchString = '%' . $_GET['searchIP'] . '%';
		$stmt->bind_param(s, $searchString);
		$stmt->execute();
		$stmt->bind_result($member_id, $first_name, $last_name, $district, $state, $party, $type);
		echo "<table border=1><th>member_id</th><th>first_name</th><th>last_name</th><th>district</th><th>state</th><th>party</th><th>type</th>\n";
		while($stmt->fetch()) {
			echo "<tr><td>$member_id</td><td>$first_name</td><td>$last_name</td><td>$district</td><td>$state</td><td>$party</td><td>$type</td></tr>";
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>

