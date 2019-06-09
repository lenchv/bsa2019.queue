<?php

namespace App\Services\DTO;

class UserData
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
