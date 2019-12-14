<?php


namespace app\controller;


use app\entity\Travel;
use App\Model\TravelerModel;
use App\Model\TravelModel;
use App\Model\UserModel;
use app\traits\TypeHinting;

class AdminController
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

    public function index() {
        global $model;
        $model["travels"] = $this->travelModel->findAll();
        $model["title"] = "Admin page";
        require_once("App/View/admin.php");
    }


}