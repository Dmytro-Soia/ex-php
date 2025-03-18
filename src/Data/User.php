<?php

namespace Jobtrek\ExPhp\Data;

class User
{
    public function __construct(
        private string $name,
        private int    $age
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): User
    {
        $this->age = $age;
        return $this;
    }

}