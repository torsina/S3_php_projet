<?php


namespace app\entity;


use app\traits\ClassUtil;
use app\traits\Uuid;

class Traveler
{
    private $id;
    private $userId;
    private $travelId;
    private $price;
    private $orderedDate;

    use ClassUtil;

    public function __construct($data)
    {
        $this->hydrate($data);
        $this->id = $this->id ? $this->id : UUid::uuid4();
        $this->orderedDate = $this->orderedDate ? $this->orderedDate : date('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getTravelId()
    {
        return $this->travelId;
    }

    /**
     * @param mixed $travelId
     */
    public function setTravelId($travelId): void
    {
        $this->travelId = $travelId;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getOrderedDate()
    {
        return $this->orderedDate;
    }

    /**
     * @param mixed $orderedDate
     */
    public function setOrderedDate($orderedDate): void
    {
        $this->orderedDate = $orderedDate;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}