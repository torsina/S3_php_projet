<?php


namespace app\model;


use app\entity\Traveler;

class TravelerModel extends Model
{
    public function __construct()
    {
        parent::__construct("traveler");
    }

    function findAll()
    {
        $data = $this->find([]);
        $result = [];
        foreach ($data as $ville) {
            $result[] = new Traveler($ville);
        }
        return $result;
    }

    function findAllFromUserOnTravel($userId, $travelId) {
        $data = $this->find(["conditions" => ["userId" => $userId, "travelId" => $travelId]]);
        $result = [];
        foreach ($data as $ville) {
            $result[] = new Traveler($ville);
        }
        return $result;
    }

    function findAllFromUser($userId) {
        $data = $this->find(["conditions" => ["userId" => $userId]]);
        $result = [];
        foreach ($data as $ville) {
            $result[] = new Traveler($ville);
        }
        return $result;
    }

    function findOneById($id)
    {
        $data = $this->find(["conditions" => ["id" => $id]]);
        if (count($data) === 0) return null;
        return new Traveler($data[0]);
    }

    function createOne(Traveler $data)
    {
        $check = $this->findOneById($data->getId());
        if ($check) return null;
        $data = $data->export();
        $this->save($data);
    }

    function updateOne(Traveler $data)
    {
        $check = $this->findOneById($data->getId());
        if (!$check) return null;
        $query = ["update" => $data->export(), "conditions" => ["userId" => $data->getUserId(), "travelId" => $data->getTravelId()]];
        return $this->edit($query);
    }


    function deleteOne($id)
    {
        return $this->delete(["id" => $id]);
    }
}