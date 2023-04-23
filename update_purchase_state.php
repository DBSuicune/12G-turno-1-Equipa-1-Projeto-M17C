<?php
    include 'db.php';

    
    $sql = "UPDATE purchase set state_id = (SELECT state.id from state WHERE state.name = '" . $_POST['state'] . "') where purchase.id = " . $_POST['id'];
    echo $sql;
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    echo json_encode($rows);



?>