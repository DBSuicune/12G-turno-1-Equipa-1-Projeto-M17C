<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["type"];
    $image = $_FILES["image"]["name"];
    $targetDir = "img/" . $type . "/";
    $targetFile = $targetDir . basename($image);


    // Move uploaded image to target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
