<?php
require_once 'autoloader.php';

//Start form here
//session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}
$cart = $_SESSION['cart'];

if (isset($_POST['item'])) {
    $item = $_POST['item'];
    $cart->updateItem($item['id'], $item['num']);
}
//to here
$request = new Request();

$action = $request->getParameter('action', 'home');
$languages = $request->getParameter('language', 'en');

// Inizialize model
if (!DB::create('localhost', 'root', '', 'webshop')) {
    die("Unable to connect to database [" . DB::getInstance()->connect_error . "]");
}


// F R O N T   C O N T R O L L E R
try {
    // Create controller
    $controller = new Controller();
    $tpl = $controller->$action($request);

    $tpl = $tpl ? $tpl : $action;

    // Create view
    $view = new View($controller);
    $view->render($tpl);
} catch (Exception $e) {
    die("<h2>There was an ERROR!</h2><p>There was an error processing action '$action'!</p><code> -> " . $e->getMessage() . "</code>");
}
