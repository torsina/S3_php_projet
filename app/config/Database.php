<?php

namespace app\config;
use PDO;
use PDOException;

class Database
{

    static private $host = "localhost";
    static private $db_name = "yelo";
    static private $username = "root";
    static private $password = "";
    static private $conn;

    static public function getConnection()
    {

        self::$conn = null;

        try {
            self::$conn = new PDO("mysql:host=" . self::$host, self::$username, self::$password);
            self::$conn->exec("set names utf8");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $testQuery = self::$conn->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'website'");
            $isDbPresent = (bool)$testQuery->fetchColumn();
            if(!$isDbPresent) self::create(self::$conn);

            self::$conn->query("use website");

        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return self::$conn;
    }

    static private function create(PDO $conn)
    {
        $sql = file_get_contents("scripts/create.sql");
        return $conn->exec($sql);
    }
}