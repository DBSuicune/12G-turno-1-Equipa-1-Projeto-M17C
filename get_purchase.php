<?php
	include 'db.php';
	$sql = "SELECT purchase.id, user.name as user_name, purchase.date, state.name as state_name from purchase
	INNER JOIN user ON purchase.user_id = user.id
	INNER JOIN state ON purchase.state_id = state.id ORDER BY id DESC";
	$result = mysqli_query($conn, $sql);
	$rows = array();
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	echo json_encode($rows);
?>
