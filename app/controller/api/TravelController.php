<?php


namespace app\controller\api;


use app\entity\Permission;
use app\entity\Travel;
use app\entity\Traveler;
use app\model\SessionModel;
use app\model\TravelerModel;
use app\model\TravelModel;
use app\model\UserModel;
use app\traits\TypeHinting;

class TravelController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function order() {
        if(!isset($_SESSION["user"])) return $this->finish(401, ["error" => "Unauthorized"]);
        if(!Permission::canOrderTravel()) return $this->finish(401, ["error" => "Unauthorized"]);
        if(!isset($_POST["id"])) return $this->finish(422, ["error" => "Invalid travel id"]);
        $travelId = $_POST["id"];
        $travel = $this->travelModel->findOne($travelId);
        if(!$travel) return $this->finish(422, ["error" => "Invalid travel id"]);
        $traveler = new Traveler(["userId" => $_SESSION["user"]["id"], "travelId" => $travel->getId(), "price" => $travel->getPrice()]);
        $this->travelerModel->createOne($traveler);
        return $this->finish(200, ["status" => "ok"]);
    }

    public function create() {
        if(!isset($_SESSION["user"])) return $this->finish(401, ["error" => "Unauthorized"]);
        if(!Permission::canOrderTravel()) return $this->finish(401, ["error" => "Unauthorized"]);
        $emptyTravel = new Travel([]);
        $names = $emptyTravel->getPropertyNames();
        unset($emptyTravel);
        unset($names["image"]);
        $formValues = [];
        $_POST["add_id"] = null;
        $_POST["add_ownerId"] = null;
        foreach ($_POST as $field => $formValue) {
            if(in_array(substr($field, 4), $names)) {
                $formValues[substr($field, 4)] = $formValue;
            }
        }
        if(count($names) > count($formValues)) return $this->finish(400, ["error" => "Invalid request"]);
        $imageName = self::uploadImage("add_image");
        if(!$imageName) return $this->finish(400, ["error" => "Missing image"]);
        $formValues["image"] = $imageName;
        $formValues["ownerId"] = $_SESSION["user"]["id"];
        $travel = new Travel($formValues);
        $result = $this->travelModel->createOne($travel);
        if(!$result) return $this->finish(500, ["error" => "Internal server error"]);
        return $this->finish(200, $travel->export());
    }

    public function edit() {

    }

    public function delete() {

    }


}