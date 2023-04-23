<?php
	include 'db.php';
	$sql = "SELECT * FROM category ORDER BY id DESC";
	$result = mysqli_query($conn, $sql);
	$rows = array();
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	echo json_encode($rows);
?>
