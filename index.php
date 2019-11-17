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

// session handling
session_start();
$__sess = $db->getSession(session_id());
if($__sess !== NULL) {
    $__sessUser = $db->getUser($__sess["userId"]);
    if($__sessUser !== NULL) $_SESSION["user"] = $__sessUser->export();
}

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
        if(!isset($_SESSION) || !isset($_SESSION["user"]) || $_SESSION["user"]["permission"] < 1) {
            require_once("controllers/pages/errorController.php");
            ErrorController::action($db, "permissionDenied");
            break;
        }
        require_once("controllers/pages/adminController.php");
        AdminController::action($db, "");
        break;
    case 'register' :
    {
        require_once("controllers/pages/registerController.php");
        RegisterController::action($db, "");
        break;
    }
    case 'member' : {
        if(!isset($_SESSION) || !isset($_SESSION["user"])) {
            header('Location: /');
            break;
        }
        require_once("controllers/pages/memberController.php");
        MemberController::action($db, "");
        break;
    }
    case 'api' :
        require_once("controllers/API/APIController.php");
        $next = $request;
        array_shift($next);
        APIController::action($db, $next);
        break;
    case "logout":
        $db->deleteSession(session_id());
        $_SESSION = []; //destroy all of the session variables
        setcookie(session_name(),time() - 42000);
        session_destroy();
        header('Location: /');

        break;
}