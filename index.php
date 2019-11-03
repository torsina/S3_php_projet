<?php

// global imports
require_once("controllers/IController.php");
require_once("utils/database/CDatabase.php");

$request = $_SERVER['REQUEST_URI'];

$db = new CDatabase();
$db->connect();

// remove the GET part of the url, split "/foo/bar" into "Array ([0]=> "foo", [1]=>"bar")
$request = explode("/", explode("?", $request)[0]);
array_shift($request);

session_start();
switch ($request[0]) {
    case '' :
        require_once("controllers/pages/mainController.php");
        MainController::action($db, "");
        break;
    default:
        header('Location: /');
        break;
    case 'travel' :
        require_once("controllers/pages/travelController.php");
        TravelController::action($db, "");
        break;
    case 'admin' :
        require_once("controllers/pages/adminController.php");
        AdminController::action($db, "");
        break;
    case 'register' :
    {
        require_once("controllers/pages/registerController.php");
        RegisterController::action($db, "");
        break;
    }
    case 'api' :
        require_once("controllers/API/APIController.php");
        $next = $request;
        array_shift($next);
        APIController::action($db, $next);
        break;
}