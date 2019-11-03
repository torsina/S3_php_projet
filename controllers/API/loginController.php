<?php


class LoginController implements IController
{

    static function action($db, $action)
    {
        switch ($action[0]) {
            case "":
                if(session_status() == PHP_SESSION_ACTIVE) {
                    session_destroy();
                    header('Location: /');
                } else {
                    session_start();
                }
                if (!isset($_POST["login"]) ||
                    !isset($_POST["password"])) {
                    header('Location: /');
                    break;
                }
                $login = $_POST["login"];
                $pass = $_POST["password"];
                $user = User::login($db, $login, $pass);
                if ($user === NULL || $user === false) {
                    require_once("controllers/pages/errorController.php");
                    switch ($user) {
                        case NULL:
                        {
                            ErrorController::action($db, "loginNotFound");
                            break;
                        }
                        case false:
                        {
                            ErrorController::action($db, "loginWrongPassword");
                            break;
                        }
                    }
                }
                session_id($user->getId());
                $_SESSION["foo"] = "bar";
                $_SESSION["user"] = $user;
                header('Location: /');
                break;
            case "register":
                if (!isset($_POST["firstName"]) ||
                    !isset($_POST["lastName"]) ||
                    !isset($_POST["displayName"]) ||
                    !isset($_POST["email"]) ||
                    !isset($_POST["password"])) {
                    header('Location: /');
                }
                $user = new User($db);
                // string $firstName, string $lastName, string $email, string $password, string $displayName = ""
                $result = $user->create($_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["password"], $_POST["displayName"]);
                header('Location: /');
        }
    }
}
