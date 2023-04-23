<?php 
    include 'db.php';

    $sql = "Select products.Name From products 
    INNER JOIN purchase_product ON products.id = purchase_product.product_id
    INNER JOIN purchase on purchase_product.purchase_id = purchase.id
    where purchase.id = " . $_POST['id'];

    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    echo json_encode($rows);





?>