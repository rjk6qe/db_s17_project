<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from Bill where title like ?") or die(mysqli_error($db))) {
		$searchString = '%' . $_GET['searchIP'] . '%';
		$stmt->bind_param(s, $searchString);
		$stmt->execute();
		$stmt->bind_result($bill_id, $member_id, $title, $committee_name);
		echo "<table border=1><th>bill_id</th><th>member_id</th><th>title</th><th>committee_name</th>\n";
		while($stmt->fetch()) {
			echo "<tr><td>$bill_id</td><td>$member_id</td><td>$title</td><td>$committee_name</td></tr>";
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>

