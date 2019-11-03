<?php
require_once("models/adminModel.php");

class AdminController implements IController
{
    static function action($db, $action)
    {
        switch ($action) {
            case "":
                global $model;
                $model = new AdminModel();
                include "views\adminView.php";
                break;
        }
    }
}