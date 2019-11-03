<?php
require_once("models/travelModel.php");


class TravelController implements IController
{
    static function action($db, $action)
    {
        switch ($action) {
            case "": {
                global $model;
                $travels = $db->getPublicTravelsData();
                $model = new TravelModel($travels);
                include "views/travelView.php";
                break;
            }
            case "/add": {
                break;
            }
        }
    }
}