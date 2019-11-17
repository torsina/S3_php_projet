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

            //$this->create();
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
                $rawTravel["name"],
                $rawTravel["image"],
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
        $didExec = $req->execute();
        if (!$didExec) return NULL;
        $res = $req->fetch(PDO::FETCH_ASSOC);
        if(!$res) return NULL;

        $travel = new Travel($this);
        $travel->initialize($res["id"],
            $res["ownerId"],
            $res["name"],
            $res["image"],
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
        if ($isTravelRegistered !== NULL) return false;

        $insert = $this->pdo->prepare("INSERT INTO website.travel (id, ownerId, name, image, createdDate, startDate, endDate, price, location, capacity, sold) VALUES "
            . "(:id, :ownerId, :name, :image, :createdDate, :startDate, :endDate, :price, :location, :capacity, :sold)");

        $insert->bindValue(":id", $travel->getId());
        $insert->bindValue(":ownerId", $travel->getOwnerId());

        $insert->bindValue(":name", $travel->getName());
        $insert->bindValue(":image", $travel->getImage());


        $insert->bindValue(":createdDate", $travel->getCreatedDate());
        $insert->bindValue(":startDate", $travel->getStartDate());
        $insert->bindValue(":endDate", $travel->getEndDate());
        $insert->bindValue(":price", $travel->getPrice());
        $insert->bindValue(":location", $travel->getLocation());
        $insert->bindValue(":capacity", $travel->getCapacity());
        $insert->bindValue(":sold", $travel->getSold());

        return $insert->execute();
    }

    function editTravel($form)
    {
        $check = $this->getTravel($form["id"]);
        if(!$check) return NULL;
        $req = $this->pdo->prepare("UPDATE website.travel SET name=:name, startDate=:startDate, endDate=:endDate, price=:price, location=:location, capacity=:capacity, description=:description WHERE id=:id");
        $req->bindParam(":name",$form["name"]);
        $req->bindParam(":startDate",$form["startDate"]);
        $req->bindParam(":endDate",$form["endDate"]);
        $req->bindParam(":price",$form["price"]);
        $req->bindParam(":location",$form["location"]);
        $req->bindParam(":capacity",$form["capacity"]);
        $req->bindParam(":description",$form["description"]);
        $req->bindParam(":id",$form["id"]);
        return $req->execute();
    }

    function getUsers()
    {
        // TODO: Implement getUsers() method.
    }

    function getUser($id)
    {
        $req = $this->pdo->prepare("SELECT * FROM website.user WHERE id=:id");
        $req->bindParam(":id", $id);
        $didExec = $req->execute();
        if (!$didExec) return NULL;
        $res = $req->fetch(PDO::FETCH_ASSOC);
        if(!$res) return NULL;

        $user = new User($this);
        $user->initialize($res["id"], $res["firstName"], $res["lastName"], $res["email"], $res["password"], $res["displayName"], $res["permission"]);
        return $user;
    }

    function getUserByCredentials($login) {
        $req = $this->pdo->prepare("SELECT * FROM website.user WHERE email=:email");
        $req->bindValue(":email", $login);
        $didExec = $req->execute();
        if (!$didExec) return NULL;
        $res = $req->fetch(PDO::FETCH_ASSOC);
        if(!$res) return NULL;

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
        print_r(" checking if user exists");
        // check that user exists
        $isUserRegistered = $this->getUserByCredentials($user->getEmail());
        if ($isUserRegistered != NULL) return false;
        print_r(" user doesn't exist");

        $insert = $this->pdo->prepare("INSERT INTO website.user (id, firstName, lastName, displayName, email, password, permission) VALUES "
            . "(:id, :firstName, :lastName, :displayName, :email, :password, :permission)");
        $insert->bindValue(":id", $user->getId());
        $insert->bindValue(":firstName", $user->getFirstName());
        $insert->bindValue(":lastName", $user->getLastName());
        $insert->bindValue(":displayName", $user->getDisplayName());
        $insert->bindValue(":email", $user->getEmail());
        $insert->bindValue(":password", $user->getPassword());
        $insert->bindValue(":permission", $user->getPermission());
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

    function setSession($sessId, $userId)
    {
        $req = $this->pdo->prepare("INSERT INTO website.sessions (sessionId, userId, expireTime) VALUES (:sessId, :userId, :expireTime)");
        $req->bindValue(":sessId",$sessId);
        $req->bindValue(":userId",$userId);
        $nextWeek = time() + (7 * 24 * 60 * 60);
        $req->bindValue(":expireTime",date("Y-m-d H:i:s", $nextWeek));
        $didExec = $req->execute();
        return $didExec;
    }

    function deleteSession($sessId)
    {
        $req = $this->pdo->prepare("DELETE FROM website.sessions WHERE sessionId=:sessId");
        $req->bindParam(":sessId", $sessId);
        $didExec = $req->execute();
        return $didExec;
    }

    function getSession($sessId)
    {
        $req = $this->pdo->prepare("SELECT * FROM website.sessions WHERE sessionId=:sessId");
        $req->bindParam(":sessId", $sessId);
        $didExec = $req->execute();
        if (!$didExec) return NULL;
        $res = $req->fetch(PDO::FETCH_ASSOC);
        if(!$res) return NULL;

        $expireTime = new DateTime($res["expireTime"]);
        $now = new DateTime();
        if($now > $expireTime) {
            $this->deleteSession($sessId);
            session_destroy();
            session_start();
            $this->setSession(session_id(), $res["userId"]);
        }
        return $res;
    }

    function deleteTravel($id)
    {
        $req = $this->pdo->prepare("DELETE FROM website.travel WHERE id=:Id");
        $req->bindParam(":Id", $id);
        $didExec = $req->execute();
        return $didExec;
    }

    function getTravelsByTraveler($userId)
    {
        $req = $this->pdo->prepare("SELECT * FROM website.traveler WHERE userId=:userId");
        $req->bindParam(":userId", $userId);
        $req->execute();
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($res as $traveler) {
            $reqTravel = $this->pdo->prepare("SELECT * FROM website.travel WHERE id=:id");
            $reqTravel->bindParam(":id", $traveler["travelId"]);
            $reqTravel->execute();
            $resTravel = $reqTravel->fetch(PDO::FETCH_ASSOC);
            $temp =  array_merge($resTravel, $traveler);
            array_push($result, array_merge($resTravel, $temp));
        }
        return $result;
    }

    function orderTravel($userId, $travelId, $price)
    {
        $check = $this->getTravel($travelId);
        if(!$check) return NULL;
        $req = $this->pdo->prepare("INSERT INTO website.traveler (userId, travelId, price) VALUES (:userId, :travelId, :price)");
        $req->bindParam(":userId", $userId);
        $req->bindParam(":travelId", $travelId);
        $req->bindParam(":price", intval($price));
        return $req->execute();
    }
}