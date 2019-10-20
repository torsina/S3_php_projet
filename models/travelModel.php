<?php

class TravelModel
{
    public $travels;
    public $columns;

    public function __construct($travels)
    {
        $this->columns = array_keys($travels[0]);
        $this->data = [];
        foreach($travels as $travel) {
            array_push($this->data, array_values($travel));
        }
    }
}
