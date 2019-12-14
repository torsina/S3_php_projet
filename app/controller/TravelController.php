<?php


namespace app\controller;


use app\entity\Travel;
use app\entity\Traveler;
use App\Model\TravelerModel;
use App\Model\TravelModel;
use App\Model\UserModel;
use app\traits\TypeHinting;

class TravelController
{
    private $travelModel;
    private $userModel;
    private $travelerModel;

    use TypeHinting;

    public function __construct()
    {
        $this->travelModel = new TravelModel();
        $this->userModel = new UserModel();
        $this->travelerModel = new TravelerModel();
    }

    function index()
    {
        global $model;
        $model["title"] = "Index";
        require_once("App/View/index.php");
    }

    function getAll()
    {
        global $model;
        $travels = $this->travelModel->findAll();
        $model["data"] = [];
        $model["data"]["travel"] = [];
        foreach ($travels as $travel) {
            $travel = $this->fakeTravelTypeHinting($travel);
            $index = count($model["data"]["travel"]);
            $model["data"]["travel"][$index]["displayName"] = $this->userModel->findOne($travel->getOwnerId())->getDisplayName();
            $model["data"]["travel"][$index]["travel"] = $travel->export();
            $model["data"]["columns"] = $travel->getPropertyNames();
        }
        $model["data"]["orderFormUrl"] = explode("?", $_SERVER['REQUEST_URI'])[0]."/order";
        echo '<pre>' . var_export($model, true) . '</pre>';
        require_once("App/View/travel.php");
    }
}