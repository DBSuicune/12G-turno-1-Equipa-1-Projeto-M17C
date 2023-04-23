<?php
	include 'db.php';
    $sql = "SELECT products.id, products.Name as product_name, products.Description, products.price, product_photo.photo, products.date_created from products
    Inner JOIN product_photo ON products.id = product_photo.product_id;";

	$result = mysqli_query($conn, $sql);
    $rows = array();


    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>
