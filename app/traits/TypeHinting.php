<?php


namespace app\traits;


use app\entity\Travel;
use app\entity\Traveler;
use app\entity\User;

trait TypeHinting
{
    private function fakeTravelTypeHinting($data) : Travel {
        return $data;
    }

    private function fakeTravelerTypeHinting($data) : Traveler {
        return $data;
    }

    private function fakeUserTypeHinting($data) : User {
        return $data;
    }
}