<?php

class TravelModel
{
    public $title;
    public $travels;
    public $columns;

    public function __construct($travels)
    {
        $this->title = "travels";
        $this->columns = array_keys($travels[0]);
        $this->data = $travels;

    }
}
