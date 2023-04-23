<?php
session_set_cookie_params(0, '/');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
  $product_id = $_POST['id'];
 
  if (!isset($_SESSION['cart_items'])) {
    $_SESSION['cart_items'] = array(); // Initialize an empty list
  }

  // Append the new product ID to the list
  array_push($_SESSION['cart_items'], $product_id);
}







?>
