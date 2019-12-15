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
        require_once("App/View/travel.php");
    }

    function getSearch() {
        global $model;
        $request = [];
        $authorized = ["search_location" => "location", "search_startDate" => "startDate", "search_endDate" => "endDate"];
        foreach ($authorized as $field => $value) {
            if(in_array($field, array_keys($_GET))  && !empty($_GET[$field])) {
                $request[$value] = $_GET[$field];
            }
        }
        $travels = $this->travelModel->findSearch($request);
        $validTravels = [];
        $seats = 1;
        if(isset($_GET["search_seats"])) $seats = (int)$_GET["search_seats"];
        foreach($travels as $index => $value) {
            $value = $this->fakeTravelTypeHinting($value);
            if($value->getCapacity() - $value->getSold() >= $seats
            && strtotime($value->getStartDate()) > strtotime("now")) {
                array_push($validTravels, $value);
            }
        }
        $travels = $validTravels;
        if(count($travels) === 0) {
            require_once("app/view/travelNoResult.php");
            return;
        } else {
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
            require_once("App/View/travel.php");
        }
    }
}