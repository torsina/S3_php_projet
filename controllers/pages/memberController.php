<?php
require_once("models/memberModel.php");

class MemberController implements IController
{
    static function action($db, $action)
    {
        $travels = $db->getTravelsByTraveler($_SESSION["user"]["id"]);
        global $model;
        $model = new MemberModel($travels);
        include "views\memberView.php";
    }
}