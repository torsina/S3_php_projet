<?php
require_once("IDatabase.php");

class CDatabase extends IDatabase
{
    private $pdo;

    // test if the database is healthy, (re)create it and fill it if necessary -
    protected function test()
    {
        // TODO: Implement test() method.
    }

    // create
    protected function create()
    {
        // TODO: Implement create() method.
    }

    protected function fill()
    {
        // TODO: Implement fill() method.
    }

    public function connect($host = "localhost", $user = "root", $pass = "")
    {
        try {
            $pdo = new PDO('mysql:host='.$host.';dbname=website', $user, $pass, array(
                PDO::ATTR_PERSISTENT => true
            ));
        } catch (PDOException $e) {
            print "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}