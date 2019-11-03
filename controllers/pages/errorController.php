<?php
require_once("models/errorModel.php");

class ErrorController implements IController
{
    static function action($db, $action)
    {
        $message = "";
        switch ($action) {
            case "loginWrongPassword":
            case "loginNotFound":
                $message = "This account doesn't exists.";
                break;
        }
        global $model;
        $model = new ErrorModel($message);
        include "views/errorView.php";
    }
}