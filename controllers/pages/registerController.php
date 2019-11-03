<?php
require_once("models/registerModel.php");

class RegisterController implements IController
{
    static function action($db, $action)
    {
        switch ($action) {
            case "":
                global $model;
                $model = new RegisterModel();
                include "views/registerView.php";
                break;
        }
    }
}