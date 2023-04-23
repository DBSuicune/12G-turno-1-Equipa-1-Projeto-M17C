<?php
    include 'db.php';

    $sql = $_POST['comando'];
    $result = mysqli_query($conn, $sql);
    $rows = array();
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	echo json_encode($rows);
    json_encode($rows);



?>