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

    public function order()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->finish(405, ["error" => "Method Not Allowed"]);
        if (!isset($_SESSION["user"])) return $this->finish(401, ["error" => "Unauthorized"]);
        if (!Permission::canOrderTravel()) return $this->finish(401, ["error" => "Unauthorized"]);
        if (!isset($_POST["id"])) return $this->finish(422, ["error" => "Invalid travel id"]);
        $travelId = $_POST["id"];
        $travel = $this->travelModel->findOne($travelId);
        if (!$travel) return $this->finish(422, ["error" => "Invalid travel id"]);
        $traveler = new Traveler(["userId" => $_SESSION["user"]["id"], "travelId" => $travel->getId(), "price" => $travel->getPrice()]);
        $this->travelerModel->createOne($traveler);
        return $this->finish(200, ["status" => "ok"]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->finish(405, ["error" => "Method Not Allowed"]);
        if (!Permission::canCreateTravel()) return $this->finish(401, ["error" => "Unauthorized"]);
        $travel = $this->create_edit_form("add");
        if ($travel === self::ERROR_CODE_RETURN) return null;
        $result = $this->travelModel->createOne($travel);
        if (!$result) return $this->finish(500, ["error" => "Internal server error"]);
        return $this->finish(200, $travel->export());
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->finish(405, ["error" => "Method Not Allowed"]);
        if (!Permission::canEditTravel()) return $this->finish(401, ["error" => "Unauthorized"]);
        $travel = $this->create_edit_form("edit");
        if($travel === self::ERROR_CODE_RETURN) return null;
        if(!$travel->getImage()) $travel->setImage($this->travelModel->findOne($travel->getId())->getImage());
        $result = $this->travelModel->updateOne($travel);
        if (!$result) return $this->finish(500, ["error" => "Internal server error"]);
        return $this->finish(200, $travel->export());
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return $this->finish(405, ["error" => "Method Not Allowed"]);
        if(!Permission::canDeleteTravel()) return $this->finish(401, ["error" => "Unauthorized"]);
        $result = $this->travelModel->deleteOne($_POST["id"]);
        if(!$result) return $this->finish(500, ["error" => "Internal server error"]);
        $result = $this->travelerModel->deleteAllFromTravel($_POST["id"]);
        if(!$result) return $this->finish(500, ["error" => "Internal server error"]);
        return $this->finish(200, ["status" => "ok"]);
    }

    private function create_edit_form($formPrefix)
    {
        if (!isset($_SESSION["user"])) return $this->finish(401, ["error" => "Unauthorized"]);
        $emptyTravel = new Travel([]);
        $names = $emptyTravel->getPropertyNames();
        unset($emptyTravel);
        unset($names[array_search("image", $names)]);
        $formValues = [];
        if($formPrefix !== "edit")$_POST[$formPrefix . "_id"] = null;
        $_POST[$formPrefix . "_ownerId"] = null;
        $_POST[$formPrefix . "_sold"] = null;
        $_POST[$formPrefix . "_createdDate"] = null;
        foreach ($_POST as $field => $formValue) {
            $name = explode($formPrefix . "_", $field);
            $name = $name[count($name) - 1];
            if (in_array($name, $names)) {
                $formValues[$name] = $formValue;
            }
        }
        if (count($names) > count($formValues)) return $this->finish(400, ["error" => "Invalid request"]);
        $imageName = self::uploadImage($formPrefix . "_image");
        if (!$imageName && $formPrefix !== "edit") return $this->finish(400, ["error" => "Missing image"]);
        $formValues["image"] = $imageName;
        $formValues["ownerId"] = $_SESSION["user"]["id"];
        $formValues["sold"] = 0;
        $formValues["createdDate"] = date("Y-m-d H:i:s");
        $formValues["startDate"] = date("Y-m-d", strtotime($formValues["startDate"]));
        $formValues["endDate"] = date("Y-m-d", strtotime($formValues["endDate"]));
        $travel = new Travel($formValues);
        return $travel;
    }



}