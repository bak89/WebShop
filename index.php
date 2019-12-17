<?php
// F R O N T   C O N T R O L L E R

require_once 'autoloader.php';

$request = new Request();
//$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$action = $request->getParameter('action', 'home');
$languages = $request->getParameter('language', 'en');

// Inizialize model
if (!DB::create('localhost', 'root', '', 'webshop')) {
    die("Unable to connect to database [" . DB::getInstance()->connect_error . "]");
}

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
