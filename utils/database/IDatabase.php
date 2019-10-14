<?php


abstract class IDatabase
{
    protected abstract function test();
    protected abstract function create();
    protected abstract function fill();

    abstract function connect($host, $user, $pass);

}