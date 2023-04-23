<?php
header('content-type: text/html; charset=utf-8');
use function PHPSTORM_META\type;
include 'db.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];
$image = $_POST['image'];

try{
    $price = floatval($price);
}catch(Exception $e){
    http_response_code(400); // set HTTP response code to 400 Bad Request
    $response = array(
        "success" => false,
        "error" => "Por favor introduza um preço válido."
    );
    echo json_encode($response);
    exit; // terminate script
};


function validate($data, $text='null'){
    if (gettype($data) == 'string'){
        $data = trim($data);
        if($data == '' or $data == null){
            http_response_code(400); // set HTTP response code to 400 Bad Request
            $response = array(
                "success" => false,
                "error" => "Por favor " . $text . " do produto."
            );
            echo json_encode($response);
            exit; // terminate script          
        }
    }elseif(gettype($data) == 'double'){
       if ($data == 0){
        http_response_code(400); // set HTTP response code to 400 Bad Request
        $response = array(
            "success" => false,
            "error" => "Por favor " . $text . " do produto."
        );
        echo json_encode($response);
        exit; // terminate script          
       }
    
}}
validate($name, 'introduza o nome');
validate($description, 'introduza a descrição');
validate($price, 'introduza o preço');

if (strpos($image, '.png') == false && strpos($image, '.jpg') == false && strpos($image, '.jpeg') == false) {
    http_response_code(400); // set HTTP response code to 400 Bad Request
    $response = array(
        "success" => false,
        "error" => "Por favor introduza uma imagem válida."
    );
    echo json_encode($response);
    exit; // terminate script
}

$category = explode(',', $category);

if (count($category) == 1 && $category[0] == '') {
    http_response_code(400); // set HTTP response code to 400 Bad Request
    $response = array(
        "success" => false,
        "error" => "Por favor introduza pelo menos 1 categoria."
    );
    echo json_encode($response);
    exit; // terminate script
}

$name = mb_convert_encoding($name, "UTF-8");
$description = mb_convert_encoding($description, "UTF-8");

$insert_product = ("INSERT INTO products (name, description, price, date_created) VALUES ('" . $name . "','" . $description . "'," . $price . ",'" . date('Y-m-d') . "')");

if ($conn->query($insert_product) == TRUE) {
    $last_id = $conn->insert_id;
    foreach ($category as $cat) {
        $insert_category = ("INSERT INTO product_category (products_id, category_id) VALUES (" . $last_id . "," . $cat . ")");
        $conn->query($insert_category);
    }
    $insert_image = ("INSERT INTO product_photo (product_id, photo) VALUES (" . $last_id . ",'" . $image . "')");
    $conn->query($insert_image);
    http_response_code(200); // set HTTP response code to 200 OK
    $response = array(
        "success" => true,
        "message" => "Produto adicionado com sucesso."
    );
    echo json_encode($response);
} else {
    http_response_code(400); // set HTTP response code to 400 Bad Request
    $response = array(
        "success" => false,
        "error" => "Erro ao adicionar o produto."
    );
    echo json_encode($response);
}









?>
