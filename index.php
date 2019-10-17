<?php

$request = $_SERVER['REQUEST_URI'];
require_once("controllers/IController.php");
switch ($request) {
    case '/' :
    case '' :
        require_once("controllers/mainController.php");
        mainController::action("");
        break;
    case '/about' :
        require __DIR__ . '/views/about.php';
        break;
    default:
        require __DIR__ . '/views/404.php';
        break;
}
