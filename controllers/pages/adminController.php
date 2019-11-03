<?php
require_once("models/adminModel.php");

class AdminController implements IController
{
    static function action($db, $action)
    {
        if (isset($_POST)
            && isset($_POST["add_travel"])
            && isset($_POST["add_name"])
            && isset($_FILES["add_image"])
            && isset($_POST["add_description"])
            && isset($_POST["add_startDate"])
            && isset($_POST["add_endDate"])
            && isset($_POST["add_price"])
            && isset($_POST["add_location"])
            && isset($_POST["add_capacity"])) {
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["add_image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["add_image"]["tmp_name"]);
                if ($check === false) {
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["add_image"]["size"] > 500000) {
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["add_image"]["tmp_name"], $target_file)) {
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }


                $travel = new Travel($db);
                $travel->create($_SESSION["user"]["id"],
                    $_POST["add_name"],
                    $_FILES["add_image"]["name"],
                    $_POST["add_description"],
                    date("Y-m-d H:i:s"),
                    date("Y-m-d", strtotime($_POST["add_startDate"])),
                    date("Y-m-d", strtotime($_POST["add_endDate"])),
                    $_POST["add_price"],
                    $_POST["add_location"],
                    $_POST["add_capacity"],
                    0);
        }


        global $model;
        $model = new AdminModel();
        include "views\adminView.php";
    }
}