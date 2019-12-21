<?php

require_once("autoloader.php");

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}
$cart = $_SESSION['cart'];

if (isset($_POST['item'])) {
    $item = $_POST['item'];
    $cart->updateItem($item['id'], $item['num']);
}

echo $cart->render();