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
    abstract function editTravel(Travel $travel);

    abstract function getUsers();
    abstract function getUser($id);
    abstract function createUser(User $user);
    abstract function editUser(User $user);

    abstract function getPublicTravelsData();
}