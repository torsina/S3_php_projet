<?php


abstract class ADatabase
{
    protected abstract function test();
    protected abstract function create();
    protected abstract function fill();

    abstract function connect($host, $user, $pass);

    abstract function getTravels();
    abstract function getTravel($id);
    abstract function createTravel(Travel $travel);
    abstract function editTravel($form);
    abstract function deleteTravel($id);

    abstract function getUsers();
    abstract function getUser($id);
    abstract function getUserByCredentials($login);
    abstract function createUser(User $user);
    abstract function editUser(User $user);

    abstract function getTravelsByTraveler($userId);
    abstract function orderTravel($userId, $travelId, $price);

    abstract function setSession($sessId, $userId);
    abstract function deleteSession($sessId);
    abstract function getSession($sessId);

    abstract function getPublicTravelsData();
}