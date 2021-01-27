<?php

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $registrationDate;

    public function __construct(int $id = null, string $name = null, string $email = null, string $registrationDate = null, string $password = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->registrationDate = $registrationDate;
    }

    public function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRegistrationDate(): string
    {
        return $this->registrationDate;
    }

}
