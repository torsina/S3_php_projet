<?php


namespace app\model;


use app\entity\User;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct("user");
    }

    function findAll() {
        $data = $this->find([]);
        $result = [];
        foreach ($data as $item) {
            $result[] = new User($item);
        }
        return $result;
    }

    function findOne($id) {
        $data = $this->find(["conditions" => ["id" => $id]]);
        if(count($data) === 0) return null;
        return new User($data[0]);
    }

    function findOneByMail($mail) {
        $data = $this->find(["conditions" => ["email" => $mail]]);
        if(count($data) === 0) return null;
        return new User($data[0]);
    }

    function createOne(User $data) {
        $check = $this->findOne($data->getId());
        if($check) return null;
        $data = $data->export();
        $this->save($data);
    }

    function deleteOne($id) {
        return $this->delete(["id" => $id]);
    }
}