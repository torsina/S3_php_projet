<?php

class ErrorModel {
    public $title;
    public $message;
    public function __construct($message)
    {
        $this->title = "Error page";
        $this->message = $message;
    }
}