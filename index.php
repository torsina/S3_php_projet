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
    case "travel":
        if (isset($request[1])) {
            switch ($request[1]) {
                case "order":
                    $travelController->order();
                    break;
                case "create":
                    if(\app\entity\Permission::canCreateTravel()) $travelController->create();
                    break;
                case "edit":
                    break;
            }
        } else {
            $travelController->getAll();
        }
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