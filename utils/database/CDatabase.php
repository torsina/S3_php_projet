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
    }

    protected function fill()
    {
        // TODO: Implement fill() method.
    }

    public function connect($host = "localhost", $user = "root", $pass = "")
    {
        try {
            $this->pdo = new PDO('mysql:host=' . $host, $user, $pass, array(
                PDO::ATTR_PERSISTENT => true
            ));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // check if db exists
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'website'");
            $isDbPresent = (bool)$stmt->fetchColumn();

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

    function getTravels()
    {
        // TODO: Implement getTravels() method.
    }

    function getTravel($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM travel WHERE id=:id");
        $req->bindParam(":id", $id);
        $doesExist = $req->execute();
        if (!$doesExist) return NULL;
        $res = $req->fetch(PDO::FETCH_ASSOC);

        $travel = new Travel($this);
        $travel->initialize($res["id"],
            $res["ownerId"],
            $res["description"],
            $res["createdDate"],
            $res["startDate"],
            $res["endDate"],
            $res["price"],
            $res["location"],
            $res["capacity"],
            $res["sold"]);
        return $travel;
    }

    function createTravel(Travel $travel)
    {
        $isTravelRegistered = $this->getTravel($travel->getId());
        if($isTravelRegistered == NULL) return false;

        $insert = $this->pdo->prepare("INSERT INTO website.travel (id, ownerId, createdDate, startDate, endDate, price, location, capacity) VALUES "
        ."(:id, :ownerId, :createdDate, :startDate, :endDate, :price, :location, :capacity)");


    }

    function editTravel(Travel $travel)
    {
        // TODO: Implement editTravel() method.
    }

    function getUsers()
    {
        // TODO: Implement getUsers() method.
    }

    function getUser($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM website.user WHERE id=:id");
        $req->bindParam(":id", $id);
        $doesExist = $req->execute();
        if (!$doesExist) return NULL;
        $res = $req->fetch(PDO::FETCH_ASSOC);

        $user = new User($this);
        $user->initialize($res["id"], $res["firstName"], $res["lastName"], $res["email"], $res["password"], $res["displayName"], $res["permission"]);
        return $user;
    }

    /**
     * @param User $user
     * @return bool true if the user didn't exist and it was inserted successfully, false otherwise
     * should maybe throw if false instead ?
     */
    function createUser(User $user)
    {
        // check that user exists
        $isUserRegistered = $this->getUser($user->getId());
        if ($isUserRegistered == NULL) return false;

        $insert = $this->pdo->prepare("INSERT INTO website.user (id, firstName, lastName, displayName, email, password, permission) VALUES "
            . "(:id, :firstName, :lastName, :displayName, :email, :password, :permission)");
        $insert->bindParam(":id", $user->getId());
        $insert->bindParam(":firstName", $user->getFirstName());
        $insert->bindParam(":lastName", $user->getLastName());
        $insert->bindParam(":displayName", $user->getDisplayName());
        $insert->bindParam(":email", $user->getEmail());
        $insert->bindParam(":password", $user->getPassword());
        $insert->bindParam(":permission", $user->getPermission());
        return $insert->execute();

    }

    function editUser($user)
    {
        // TODO: Implement editUser() method.
    }

}