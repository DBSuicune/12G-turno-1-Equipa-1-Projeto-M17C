<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "karma";


$conn = new mysqli($servername, $username, $password, $dbname);

mysqli_set_charset($conn, "utf8"); // SUPER IMPORTANTE PARA NÃO DAR ERROS DE CARACTERES

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>