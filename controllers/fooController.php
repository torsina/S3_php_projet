<?php
include "models\MyModel.php";

class fooController
{
    function action($action)
    {
        switch ($action) {
            case "add":
                // here live the logic, information, call for services and such.
                //$models =....;
                // and finally...
                include "views\MyView.php";
                break;
        }
    }
}

?>