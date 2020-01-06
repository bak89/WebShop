<?php
require_once 'autoloader.php';

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}
$cart = $_SESSION['cart'];

if (isset($_POST['item'])) {
    $item = $_POST['item'];
    $cart->updateItem($item['id'], $item['num']);
    $cart->render();
}

if(array_key_exists("mode", $_POST)) {
    $cart = $_SESSION['cart'];

    $items = $cart->getItems();
    $id = $_POST['id'];
    if($_POST['mode'] == "addItem") {
        $cart->updateItem($id, 1);
    } else {
        $cart->updateItem($id,-1);
    }
}

if (isset($_POST['item'])) {
    $item = $_POST['item'];
    if (isset($item)) {
        $cart->updateItem($item['id'], $item['num']);
    }
    $cart->render();
}

