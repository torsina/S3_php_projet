<?php


namespace app\controller\api;


use app\model\SessionModel;
use app\model\TravelerModel;
use app\model\TravelModel;
use app\model\UserModel;
use app\traits\TypeHinting;

class ApiController
{
    protected $userModel;
    protected $travelModel;
    protected $travelerModel;
    protected $sessionModel;

    const ERROR_CODE_RETURN = -1;

    use TypeHinting;

    public function __construct()
    {
        $this->travelModel = new TravelModel();
        $this->userModel = new UserModel();
        $this->travelerModel = new TravelerModel();
        $this->sessionModel = new SessionModel();
    }

    public function finish($errorCode, $data) {
        require_once("app/view/api.php");
        return self::ERROR_CODE_RETURN;
    }

    static function uploadImage($imageName) {
        if(!isset($_FILES[$imageName]) || !isset($_FILES[$imageName]["tmp_name"]) || $_FILES[$imageName]["tmp_name"] == "") return;
        $target_dir = "images/";
        $target_file = $target_dir . htmlspecialchars(basename($_FILES[$imageName]["name"]));
        $uploadOk = true;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES[$imageName]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES[$imageName]["size"] > 5000000) {
            $uploadOk = false;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $uploadOk = false;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk === false) {
            return NULL;
            // if everything is ok, try to upload file
        } else {
            if (!move_uploaded_file($_FILES[$imageName]["tmp_name"], $target_file)) return NULL;
            else return htmlspecialchars(basename($_FILES[$imageName]["name"]));
        }
    }
}