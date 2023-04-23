<?php 
include 'db.php';

$category = $_POST['category'];

if ($category != "") {
    $sql = "INSERT INTO category (name) VALUES ('$category')";
    $result = $conn->query($sql);
    
    if (!$result) {
        $error = mysqli_error($conn);
        http_response_code(500); // set the HTTP status code to 500 (Internal Server Error)
        echo json_encode(array("error" => $error)); // return a JSON object that includes the error message
    }
    else {
        echo json_encode(array("success" => "Category added successfully")); // return a JSON object that includes the success message
    }
}
else {
    http_response_code(400); // set the HTTP status code to 400 (Bad Request)
    echo json_encode(array("error" => "Category name is required")); // return a JSON object that includes the error message
}

?>
