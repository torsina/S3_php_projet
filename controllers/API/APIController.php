<?php
class APIController implements IController
{
    static function action($db, $action)
    {
        $next = $action;
        array_shift($next);
        if($_SERVER["REQUEST_METHOD"]!='POST') {
            header('Location: /');
            return;
        }
        switch ($action[0]) {
            case "login":
                require_once("controllers/API/loginController.php");
                LoginController::action($db, $next);
        }
    }
}