<?php
require_once("utils/Uuid.php");

/**
 * Class User
 * representation of a user
 */
class User
{
    private $initialized = false;
    private $db;

    private $id;
    private $firstName;
    private $lastName;
    private $displayName;
    private $email;
    private $password;
    /**
     * @var int $permission
     * represent the permission level of the user
     * 0 = standard user
     * 1 = travel company
     * 2 = administrator
     */
    private $permission;

    // password is encrypted in the constructor
    function __construct(CDatabase $db)
    {
        $this->db = $db;
    }

    /**
     * Create a new user that will be stored in the database
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $displayName
     * @return bool whether the creation was successfull or not
     */
    function create(string $firstName, string $lastName, string $email, string $password, string $displayName = "")
    {
        if (!$this->initialized) {

            $this->id = Uuid::uuid4();
            $this->firstName = htmlspecialchars($firstName);
            $this->lastName = htmlspecialchars($lastName);
            $this->displayName = $displayName == "" ? $this->firstName . " " . $this->lastName : htmlspecialchars($displayName);
            $this->email = htmlspecialchars($email);
            $salt = hash("sha512", $this->id . $password);
            $this->password = hash("sha512", $password . $salt);

            $this->initialized = !!$this->db->createUser($this);
        }
        return $this->initialized;
    }

    function initialize(string $id, string $firstName, string $lastName, string $email, string $password, string $displayName, int $permission)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->displayName = $displayName;
        $this->permission = $permission;

        $this->initialized = true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function setDisplayName($displayName): void
    {
        $this->displayName = $displayName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getPermission()
    {
        return $this->permission;
    }

    public function setPermission($permission): void
    {
        $this->permission = $permission;
    }


}