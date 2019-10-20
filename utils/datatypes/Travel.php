<?php
require_once("utils/Uuid.php");

/**
 * travel:
 * -id
 * -ownerId
 * -description
 * -createdDate
 * -startDate
 * -endDate
 * -price
 * -location
 * -capacity
 * -sold
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

    /**
     * 
     * @param string $ownerId
     * @param string $description
     * @param string $createdDate
     * @param string $startDate
     * @param string $endDate
     * @param int $price
     * @param string $location
     * @param int $capacity
     * @param int $sold
     * @return bool
     */
    function create(string $ownerId,
                    string $description,
                    string $createdDate,
                    string $startDate,
                    string $endDate,
                    int $price,
                    string $location,
                    int $capacity,
                    int $sold)
    {
        if (!$this->initialized) {
            // check if owner exists
            $owner = $this->db->getUser($ownerId);
            if ($owner == NULL) return false;

            $this->id = Uuid::uuid4();
            $this->description = htmlspecialchars($description);
            $this->createdDate = htmlspecialchars($createdDate);
            $this->startDate = htmlspecialchars($startDate);
            $this->endDate = htmlspecialchars($endDate);
            $this->price = $price;
            $this->location = htmlspecialchars($location);
            $this->capacity = $capacity;
            $this->sold = $sold;

            $this->initialized = !!$this->db->createTravel($this);
            return $this->initialized;
        } else {
            return false;
        }

    }

    function initialize(string $id,
                        string $ownerId,
                        string $description,
                        string $createdDate,
                        string $startDate,
                        string $endDate,
                        int $price,
                        string $location,
                        int $capacity,
                        int $sold)
    {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->description = $description;
        $this->createdDate = $createdDate;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->price = $price;
        $this->location = $location;
        $this->capacity = $capacity;
        $this->sold = $sold;

        $this->initialized = true;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @return mixed
     */
    public function getSold()
    {
        return $this->sold;
    }
}