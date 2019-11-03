<?php
require_once("models/mainModel.php");

class MainController implements IController
{
    static function action($db, $action)
    {
        switch ($action) {
            case "":
                // here live the logic, information, call for services and such.
                //$models =....;
                // and finally...
                global $model;
                $model = new MainModel();
                include "views\mainView.php";
                break;
        }
    }
}