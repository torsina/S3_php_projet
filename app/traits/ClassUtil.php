<?php


namespace app\traits;


use ReflectionClass;

trait ClassUtil
{
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method(htmlspecialchars($value));

            }
        }
    }

    public function export() {
        try {
            $reflectionClass = new ReflectionClass(get_class($this));
        } catch (\ReflectionException $e) {
            print_r($e->getMessage());
        }
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($this);
            $property->setAccessible(false);
        }
        return $array;
    }

    public function getPropertyNames() {
        try {
            $reflectionClass = new ReflectionClass(get_class($this));
        } catch (\ReflectionException $e) {
            print_r($e->getMessage());
        }
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[] = $property->getName();
            $property->setAccessible(false);
        }
        return $array;
    }

    public function isMissingValues() {
        try {
            $reflectionClass = new ReflectionClass(get_class($this));
        } catch (\ReflectionException $e) {
            print_r($e->getMessage());
        }
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $test = empty($property->getValue($this)) && $property->getValue($this) !== "0";
            //print_r("<br>testing property: ".$property->getName()." ; result: ".var_dump($property->getValue($this)."<br>"));
            $property->setAccessible(false);
            if($test) return true;
        }
        return false;
    }
}