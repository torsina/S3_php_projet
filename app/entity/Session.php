<?php


namespace app\entity;


use app\traits\ClassUtil;
use DateTime;

class Session
{
    private $sessionId;
    private $userId;
    private $expireTime;
    use ClassUtil;

    public function __construct($data)
    {
        $this->hydrate($data);
        if(empty($this->expireTime)) {
            try {
                $this->expireTime = new DateTime();
                $this->expireTime->add(new \DateInterval("P1W"));
            } catch (\Exception $e) {
                print_r($e->getFile().":".$e->getLine()." ".$e->getMessage());
            }
        }
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param mixed $sessionId
     */
    public function setSessionId($sessionId): void
    {
        $this->sessionId = $sessionId;
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
    public function getExpireTime() : DateTime
    {
        return $this->expireTime;
    }

    /**
     * @param mixed $expireTime
     * @throws \Exception
     */
    public function setExpireTime($expireTime): void
    {
        if(isset($expireTime) && !($expireTime instanceof DateTime)) {
            try {
                $expireTime = new DateTime($expireTime);
            } catch (\Exception $e) {
                print_r($e->getFile().":".$e->getLine()." ".$e->getMessage());
            }
        }
        $this->expireTime = $expireTime;
    }
}