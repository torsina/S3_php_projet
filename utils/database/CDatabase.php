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
        $sql = file_get_contents("scripts/create.sql");
        return $this->pdo->exec($sql);
        // TODO: Implement create() method.
    }

    protected function fill()
    {
        // TODO: Implement fill() method.
    }

    public function connect($host = "localhost", $user = "root", $pass = "")
    {
        try {
            $this->pdo = new PDO('mysql:host='.$host, $user, $pass, array(
                PDO::ATTR_PERSISTENT => true
            ));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // check if db exists
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'website'");
            $isDbPresent = (bool) $stmt->fetchColumn();

            $this->create();
            $this->pdo->query("use website");
        } catch (PDOException $e) {
            print "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function __construct()
    {

    }
}