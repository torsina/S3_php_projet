<?php


namespace app\entity;


use app\traits\ClassUtil;
use app\traits\Uuid;

class User
{
    private $id;
    private $firstName;
    private $lastName;
    private $displayName;
    private $email;
    private $password;
    private $permission;
    use ClassUtil;

    public function __construct($data)
    {
        $this->hydrate($data);
        $this->id = $this->id ? $this->id : UUid::uuid4();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = htmlspecialchars($firstName);
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = htmlspecialchars($lastName);
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName): void
    {
        $this->displayName = $displayName == "" ? $this->firstName . " " . $this->lastName : htmlspecialchars($displayName);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = htmlspecialchars($email);
    }

    /**
     * @return mixed salted password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password cleartext password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function hashPassword() {
        $salt = hash("sha512", $this->getId());
        $this->password = hash("sha512", $this->password.$salt);
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission): void
    {
        $this->permission = $permission;
    }

    public function getSaltedPassword($_password) {
        $_salt = hash("sha512", $this->getId());
        print_r("<br>my salt: ".$_salt);
        $pass = hash("sha512", $_password.$_salt);
        print_r("<br>my pass: ".$pass);
        print_r("<br>real pass: ".$this->password);
        return $pass;
    }
}