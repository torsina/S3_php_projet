<?php


class MemberModel
{
    public $title;
    public $travels;
    public function __construct($travels)
    {
        $this->title = "member page";
        $this->travels = $travels;
    }
}