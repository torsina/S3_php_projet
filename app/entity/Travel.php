<?php


namespace app\entity;


use app\traits\ClassUtil;
use app\traits\Uuid;

class Travel
{
    private $id;
    private $ownerId;
    private $name;
    private $image;
    private $description;
    private $createdDate;
    private $startDate;
    private $endDate;
    private $price;
    private $location;
    private $capacity;
    private $sold;

    use ClassUtil;
    function __construct($data)
    {
        $this->hydrate($data);
        $this->id = $this->id ? $this->id : UUid::uuid4();
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $ownerId
     */
    public function setOwnerId($ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = htmlspecialchars($name);
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = htmlspecialchars($image);
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = htmlspecialchars($description);
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate): void
    {
        $this->createdDate = htmlspecialchars($createdDate);
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = htmlspecialchars($startDate);
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = htmlspecialchars($endDate);
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = htmlspecialchars((int)$price);
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = htmlspecialchars($location);
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity): void
    {
        $this->capacity = htmlspecialchars($capacity);
    }

    /**
     * @param mixed $sold
     */
    public function setSold($sold): void
    {
        $this->sold = htmlspecialchars($sold);
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

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
}