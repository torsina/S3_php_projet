<?php


namespace app\controller;


use App\Model\TravelerModel;
use App\Model\TravelModel;
use App\Model\UserModel;
use app\traits\TypeHinting;

class UserController
{
    private $userModel;
    private $travelModel;
    private $travelerModel;

    use TypeHinting;

    public function __construct()
    {
        $this->travelModel = new TravelModel();
        $this->userModel = new UserModel();
        $this->travelerModel = new TravelerModel();
    }

    function getTravels() {
        global $model;
        $model["title"] = "Member page";
        if(!isset($_SESSION["user"])) return header('Location: /');
        $travelers = $this->travelerModel->findAllFromUser($_SESSION["user"]["id"]);
        $travels = [];
        foreach ($travelers as $traveler) {
            $traveler = $this->fakeTravelerTypeHinting($traveler);
            $travels[] = $this->travelModel->findOne($traveler->getTravelId())->export();
        }
        $model["travels"] = $travels;
        require_once("App/View/member.php");
        return true;
    }
}