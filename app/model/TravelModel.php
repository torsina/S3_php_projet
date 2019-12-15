<?php


namespace app\model;



use app\entity\Travel;

class TravelModel extends Model
{
    public function __construct()
    {
        parent::__construct("travel");
    }

    function findAll() {
        $data = $this->find([]);
        $result = [];
        foreach ($data as $ville) {
            $result[] = new Travel($ville);
        }
        return $result;
    }

    function findOne($id) {
        $data = $this->find(["conditions" => ["id" => $id]]);
        if(count($data) === 0) return null;
        return new Travel($data[0]);
    }

    function findSearch($query) {
        $data = $this->find(["conditions" => $query]);
        $result = [];
        foreach ($data as $ville) {
            $result[] = new Travel($ville);
        }
        return $result;
    }

    function createOne(Travel $data) {
        $check = $this->findOne($data->getId());
        if($check) return null;
        $data = $data->export();
        return $this->save($data);
    }

    function updateOne(Travel $data) {
        $check = $this->findOne($data->getId());
        if(!$check) return null;
        $query = ["update" => $data->export(), "conditions" => ["id" => $data->getId()]];
        return $this->edit($query);
    }


    function deleteOne($id) {
        return $this->delete(["id" => $id]);
    }

}