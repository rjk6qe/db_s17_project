<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from Committee where committee_name like ?") or die(mysqli_error($db))) {
		$searchString = '%' . $_GET['searchIP'] . '%';
		$stmt->bind_param(s, $searchString);
		$stmt->execute();
		$stmt->bind_result($committee_id, $committee_name);
		echo "<table border=1><th>committe_id</th><th>committee_name</th>\n";
		while($stmt->fetch()) {
			echo "<tr><td>$committe_id</td><td>$committee_name</td></tr>";
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>

