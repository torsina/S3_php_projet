<?php

$request = $_SERVER['REQUEST_URI'];
require_once("controllers/IController.php");
require_once("utils/database/CDatabase.php");
$db = new CDatabase();
$db->connect();
$request = explode("?", $request);
switch ($request[0]) {
    case '/' :
    case '' :
    default:
        require_once("controllers/mainController.php");
        MainController::action($db, "");
        break;
    case '/travel' :
        require_once("controllers/travelController.php");
        TravelController::action($db, "");
        break;
}
