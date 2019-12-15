<?php


namespace app\controller;


use app\entity\Session;
use app\entity\User;
use App\Model\SessionModel;
use App\Model\UserModel;

class LoginController
{
    // login failures
    private const LOGIN_MISSING_MAIL = 0;
    private const LOGIN_MISSING_PASSWORD = 1;
    private const LOGIN_INVALID_MAIL = 2;
    private const LOGIN_INVALID_PASSWORD = 3;
    private const LOGIN_INVALID_SESSION = 4;
    private const LOGIN_UNKNOWN_USER = 5;

    // register failures
    private const REGISTER_MISSING_DATA = -1;
    private const REGISTER_MAIL_USED = -2;



    private $sessionModel;
    private $userModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->userModel = new UserModel();
    }

    public function register() {
        // prevent forged POST request to set it's id or it's permission level
        $_POST["id"] = null;
        $_POST["permission"] = 0;
        if(isset($_POST["email"])) {
            $user = new User($_POST);
            $user->hashPassword();
            if($user->isMissingValues()) return $this->failedRegister(self::REGISTER_MISSING_DATA);
            $check = $this->userModel->findOneByMail($user->getEmail());
            if($check) return $this->failedRegister(self::REGISTER_MAIL_USED);
            $this->userModel->createOne($user);
            $this->fillSession($user);
        }
        require_once("App/View/register.php");
        return true;
    }

    public function login() {
        if(session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
            session_start();
        } else {
            session_start();
        }
        if(!isset($_POST["login"])) return $this->failedLogin(self::LOGIN_MISSING_MAIL);

        if (!isset($_POST["password"])) return $this->failedLogin(self::LOGIN_MISSING_PASSWORD);
        $login = $_POST["login"];
        $password = $_POST["password"];
        $user = $this->userModel->findOneByMail($login);
        if(!$user) return $this->failedLogin(self::LOGIN_INVALID_MAIL);
        if($user->getSaltedPassword($password) !== $user->getPassword()) return $this->failedLogin(self::LOGIN_INVALID_PASSWORD);
        $this->fillSession($user);
        header('Location: /');
        return true;
    }

    public function logout() {
        if(session_status() !== PHP_SESSION_ACTIVE) return;
        $this->sessionModel->deleteOne(session_id());
        session_destroy();
        header('Location: /');
        return;
    }

    public function loadSession() {
        $_SESSION = [];
        if(session_status() != PHP_SESSION_ACTIVE) session_start();
        $session = $this->sessionModel->findOneBySessionId(session_id());
        if(!$session) return $this->failedLogin(self::LOGIN_INVALID_SESSION);
        $user = $this->userModel->findOne($session->getUserId());
        if(!$user) {
            // session points to unknown user, cleanup
            $this->sessionModel->deleteOne($session->getSessionId());
            return $this->failedLogin(self::LOGIN_UNKNOWN_USER);
        }
        $this->fillSession($user);
        return true;
    }

    private function fillSession(User $user) {
        $_SESSION["user"] = $user->export();
        $session = new Session(["userId" => $user->getId(), "sessionId" => session_id()]);
        $this->sessionModel->createOne($session);
    }

    private function failedLogin($reason) {
        //print_r("<br> login failed: ".$reason);
        // TODO: failed login behavior
        return null;
    }

    private function failedRegister($reason) {
        //print_r("<br> register failed: ".$reason);
        // TODO: failed register behavior
        return null;
    }
}