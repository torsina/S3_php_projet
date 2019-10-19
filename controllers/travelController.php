<?php
require_once("models/travelModel.php");


class travelController implements IController
{
    static function action($action)
    {
        switch ($action) {
            case "":
                global $model;
                $model = new mainModel();
                include "views\travelView.php";
                break;
        }
    }
}