<?php


namespace app\model;


use app\config\Database;
use PDO;

class Model
{
    private $connection;
    private $table;

    protected function __construct($table)
    {
        $this->connection = Database::getConnection();
        $this->table = $table;
    }

    protected function find($reqData)
    {
        // SELECT
        $statement = "SELECT ";
        if (isset($reqData["fields"])) {
            foreach ($reqData["fields"] as $index => $field) {
                $statement .= $field;
                if ($index < count($reqData["fields"]) - 1) {
                    $statement .= ", ";
                } else {
                    $statement .= " ";
                }
            }
        } else {
            // all fields
            $statement .= "* ";
        }


        // FROM OTHER TABLE
        if (isset($reqData["othertable"])) {
            foreach ($reqData["othertable"] as $index => $otherTable) {
                $statement .= $otherTable;
                if ($index < count($reqData["othertable"]) - 1) {
                    $statement .= ", ";
                } else {
                    $statement .= " ";
                }
            }
        } else {
            $statement .= "FROM " . $this->table . " ";
        }

        // WHERE
        if (isset($reqData["conditions"])) {
            $statement .= "WHERE ";
            $index = 0;
            foreach ($reqData["conditions"] as $column => $value) {
                $statement .= $column . "='" . $value . "'";
                if ($index < count($reqData["conditions"]) - 1) {
                    $statement .= ", ";
                } else {
                    $statement .= " ";
                }
                $index++;
            }
        }

        // LIMIT
        if (isset($reqData["limit"])) {
            $statement .= "LIMIT " . $reqData["limit"] . " ";
        }

        // ORDER
        if (isset($reqData["order"])) {
            foreach ($reqData["order"] as $index => $column) {
                $statement .= $column;
                if ($index < count($reqData["order"]) - 1) {
                    $statement .= ", ";
                } else {
                    $statement .= " ";
                }
            }
            $statement .= " ASC ";
        }

        $statement .= ";";

        $req = $this->connection->prepare($statement);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function read($id)
    {
        $req = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE id=:id");
        $req->bindValue(":id", $id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    protected function edit($data)
    {
        $statement = "UPDATE " . $this->table . " SET ";
        $index = 0;
        foreach ($data["update"] as $column => $value) {
            $statement .= $column . "='" . $value . "'";
            $index++;
            if ($index < count($data["update"])) {
                $statement .= ", ";
            } else {
                $statement .= " ";
            }
        }
        $statement .= "WHERE ";
        $index = 0;
        foreach ($data["conditions"] as $column => $value) {
            $statement .= $column . "='" . $value . "'";
            if ($index < count($data["conditions"])) {
                $statement .= ", ";
            } else {
                $statement .= " ";
            }
            $index++;
        }
        $req = $this->connection->prepare($statement);
        return $req->execute();
    }

    protected function save($fields)
    {
        $str = "INSERT INTO {$this->table} (";
        $str .= implode(",", array_keys($fields));
        $str .= ") VALUES (";
        $index = 0;
        foreach ($fields as $columns => $value) {
            if($value instanceof \DateTime) {
                $value = $value->format("Y-m-d H:i:s");
            }
            $str .= "'" . $value . "'";
            if ($index < count($fields) - 1) {
                $str .= ",";
            }
            $index++;
        }

        $str .= ")";
        $prepared_statement = $this->connection->prepare($str);
        return $prepared_statement->execute();
    }

    protected function delete($data)
    {
        $statement = "DELETE FROM " . $this->table . " WHERE ";
        $index = 0;
        foreach ($data as $column => $value) {
            $statement .= "".$column . "='" . $value . "'";
            if ($index < count($data) - 1) {
                $statement .= ", ";
            } else {
                $statement .= " ";
            }
            $index++;
        }

        print_r("<br>".$statement);
        $req = $this->connection->prepare($statement);
        return $req->execute();
    }
}