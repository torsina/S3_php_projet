<?php
require_once("models/mainModel.php");

class mainController implements IController
{
    static function action($action)
    {
        switch ($action) {
            case "":
                // here live the logic, information, call for services and such.
                //$models =....;
                // and finally...
                global $model;
                $model = new mainModel();
                include "views\mainView.php";
                break;
        }
    }
}