<?php
require_once("utils/Uuid.php");

/**
 * travel:
-id
-ownerId
-description
-createdDate
-startDate
-endDate
-price
-location
-capacity
-sold
 */

/**
 * Class Travel
 */
class Travel
{
    private $initialized = false;
    private $db;


    private $id;
    private $ownerId;
    private $description;
    private $createdDate;
    private $startDate;
    private $endDate;
    private $price;
    private $location;
    private $capacity;
    private $sold;

    function __construct(CDatabase $db)
    {
        $this->db = $db;
    }

    function create() {
        if(!$this->initialized) {

        }

    }

    function initialize() {

    }
}