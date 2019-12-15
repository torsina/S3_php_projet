<?php

//autoload
function chargerClasse($classe)
{
    $classe = str_replace('\\', '/', $classe);
    require $classe . '.php';
}

spl_autoload_register('chargerClasse'); //fin Autoload

$request = explode("/", explode("?", $_SERVER['REQUEST_URI'])[0]);
array_shift($request);

$loginController = new \app\controller\LoginController();
// load session if exists
$loginController->loadSession();
$model = [];
// controller declarations
$travelController = new \app\controller\TravelController();
$userController = new \app\controller\UserController();
$adminController = new \app\controller\AdminController();

switch ($request[0]) {
    case "":
    default:
        $travelController->index();
        break;
    case "api":
        if(isset($request[1])) {
            switch($request[1]) {
                case "travel":
                    $apiTravelController = new \app\controller\api\TravelController();
                    if(isset($request[2])) {
                        switch ($request[2]) {
                            case "order":
                                $apiTravelController->order();
                                break;
                            case "create":
                                $apiTravelController->create();
                                break;
                            case "edit":
                                $apiTravelController->edit();
                                break;
                            case "delete":
                                $apiTravelController->delete();
                        }
                    }
                    break;
            }
        }
        break;
    case "travel":
        $travelController->getAll();
        break;
    case "register":
        $loginController->register();
        break;
    case "login":
        $loginController->login();
        break;
    case "logout":
        $loginController->logout();
        break;
    case "member":
        if(\app\entity\Permission::canUseMemberPage()) $userController->getTravels();
        else header('Location: /');
        break;
    case "admin":
        if(\app\entity\Permission::canUseAdminPage())  $adminController->index();
        break;
}