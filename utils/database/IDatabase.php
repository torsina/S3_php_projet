<?php


abstract class IDatabase
{
    protected abstract function test();
    protected abstract function create();
    protected abstract function fill();

    abstract function connect($host, $user, $pass);

    abstract function getTravels();
    abstract function getTravel();
    abstract function createTravel();
    abstract function editTravel(Travel $travel);

    abstract function getUsers();
    abstract function getUser($id);
    abstract function createUser(User $user);
    abstract function editUser(User $user);
}