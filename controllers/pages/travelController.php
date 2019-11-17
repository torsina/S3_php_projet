<?php
require_once("models/travelModel.php");


class TravelController implements IController
{
    static function action($db, $action)
    {
        if(isset($_POST) && isset($_POST["id"]) && isset($_SERVER) && isset($_SESSION["user"])) {
            $travel = $db->getTravel($_POST["id"]);
            if($travel) {
                $db->orderTravel($_SESSION["user"]["id"], $_POST["id"], $travel->getPrice());
            }
        }
        global $model;
        $travels = $db->getPublicTravelsData();
        $model = new TravelModel($travels);
        include "views/travelView.php";
    }
}