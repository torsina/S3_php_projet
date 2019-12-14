<?php


namespace app\model;


use app\entity\Session;

class SessionModel extends Model
{
    public function __construct()
    {
        parent::__construct("sessions");
    }

    function findOneBySessionId($sessionId) {
        $data = $this->find(["conditions" => ["sessionId" => $sessionId]]);
        if(count($data) === 0) return null;
        $data = new Session($data[0]);
        $now = new \DateTime();
        if($now > $data->getExpireTime()) {
            $this->deleteOne($data->getSessionId());
            $data->setSessionId(session_id());
            try {
                $data->setExpireTime(new \DateTime());
                $data->setExpireTime($data->getExpireTime()->add(new \DateInterval("P1W")));
            } catch (\Exception $e) {
                print_r($e->getFile().":".$e->getLine()." ".$e->getMessage());
            }
            $this->createOne($data);

        }
        return $data;
    }

    function createOne(Session $data) {
        $check = $this->findOneBySessionId($data->getSessionId());
        if($check) return null;
        $data = $data->export();
        $this->save($data);
    }

    function deleteOne($id) {
        $this->delete(["sessionId" => $id]);
    }
}