<?php

class travelModel
{
    public $travels;
    // array of object type hinting workaround using variadic arguments
    // from: https://stackoverflow.com/a/34273821
    public function __construct(Travel ...$travels)
    {
        $this->travels = $travels;
    }
}
