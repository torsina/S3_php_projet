<?php

class AdminModel {
    public $title;
    public $travels;
    public function __construct($travels)
    {
        $this->travels = $travels;
        $this->title = "Admin page";
    }
}