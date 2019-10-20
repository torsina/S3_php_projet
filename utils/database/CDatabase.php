<?php
require_once("ADatabase.php");
require_once("utils/datatypes/Travel.php");
require_once("utils/datatypes/User.php");


class CDatabase extends ADatabase
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
        $req = $this->pdo->prepare("SELECT * FROM website.travel");
        $req->execute();
        $rawTravels = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rawTravels as $rawTravel) {
            $travel = new Travel($this);
            $travel->initialize($rawTravel["id"],
                $rawTravel["ownerId"],
                $rawTravel["description"],
                $rawTravel["createdDate"],
                $rawTravel["startDate"],
                $rawTravel["endDate"],
                $rawTravel["price"],
                $rawTravel["location"],
                $rawTravel["capacity"],
                $rawTravel["sold"]);
            array_push($result, $travel);
        }
        return $result;
    }

    function getTravel($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM website.travel WHERE id=:id");
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
        if ($isTravelRegistered == NULL) return false;

        $insert = $this->pdo->prepare("INSERT INTO website.travel (id, ownerId, createdDate, startDate, endDate, price, location, capacity, sold) VALUES "
            . "(:id, :ownerId, :createdDate, :startDate, :endDate, :price, :location, :capacity, :sold)");

        $insert->bindParam(":id", $travel->getId());
        $insert->bindParam(":ownerId", $travel->getOwnerId());
        $insert->bindParam(":createdDate", $travel->getCreatedDate());
        $insert->bindParam(":startDate", $travel->getStartDate());
        $insert->bindParam(":endDate", $travel->getEndDate());
        $insert->bindParam(":price", $travel->getPrice());
        $insert->bindParam(":location", $travel->getLocation());
        $insert->bindParam(":capacity", $travel->getCapacity());
        $insert->bindParam(":sold", $travel->getSold());

        return $insert->execute();
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

    function getPublicTravelsData()
    {
        $req = $this->pdo->prepare("SELECT T.*, U.displayName FROM website.travel T JOIN website.user U ON T.ownerId=U.id");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);

    }
}